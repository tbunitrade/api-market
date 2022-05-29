<?php 
namespace App\http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LotRequest;
use App\Http\Resources\LorResource;
use App\Models\Item;
use App\Models\Lot;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LotController extends Controller {

    public function index(){
        return LotResource::collection(Lot::query()->orderBy('id', 'desc')->get());        
    }

    public function store(Request $request) {
        $this->validate($request,[
            'user_id'=> 'required|integer',
            'item_id'=> 'required|integer',
            'but_id'=> 'required|integer',
            'count'=> 'required|integer',
        ]);

        $user = User::query()->find($request->input('user_id'));
        $item = Item::query()->find($request->input('item_id'));

        $userCount = DB::table('item_user')->where('item_id', $item['id'])->where('user_id', $user['id'])->first();

        if($userCount->count < $request->input('count')) {
            return response('Not enough items you have', 204);
        }

        $new = $userCount->count - $request->input('count');

        $user->items()->syncWithPivotValues($item['id'],['count' => $new]);

        $lot = Lot::query()->create($request->all());

        return new LotResource($lot);
    }

    public function destroy(Lot $lot) {
        DB::table('item_user')->where('item_id', $lot['item_id'])->where('user_id',$lot['user_id'])->increment('count', $lot['count']);
        $lot->delete();

        return response(null, 204);

    }

    public function trade(Lot $lot, Request $request) {
        $this->validate($request,[
            'costumer_id' => 'required|integer',
        ]);

        $costumer = User::query()->find($request->input('costumer_id'));
        $count = $lot['count'];
        $seller = DB::table('item_user')->where('user_id', $request->input('costumer_id'))->where('item_id', $lot['item_id'])->first();

        if (!$seller) {
            return response("You do not have item(s)", 204);
        }

        if ($seller->count < $lot['buy_id']) {
            return response("Not enough items, need: $seller->count", 204);
        }

        if ($res = BD::table('item_user')->where('item_id',$lot['item_id'])->where('user_id', $costumer['id'])->first()) {
            $count += $res->count;
        }

        $costumer->items()->sync(lot['item_id'],['count'=>$count]);
        $lot->delete();

        return response("Congratulations your deal has bee approved !",200);//
    }
}

?>