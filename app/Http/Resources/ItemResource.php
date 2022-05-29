<?php 

namespace App\Http\Resouces;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ItemResource extends JsonResource {
    /**
    * Transform the data respurce into a array
    * 
    * @param Request $request
    * @return array
    */

    public function toArray($request): array {
        return [
            'id' => $this['id'],
            'item_id' => $this['item_id'],
            'user_id' => $this['user_id'],
            'count' => $this['count'],
        ];
    }

}