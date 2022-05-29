<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resouerces\Userresource;
use App\Models\User;
use Illuminate\Http\Resouces\Json\AnonymousResourceCollection;

class userController extends Controller {
    /**
     * @return AnonymousResourceCollection
     */

     public function get(): AnonymousResourceCollection {
         return UserResouce::collection(User::all());
     }
}
?>