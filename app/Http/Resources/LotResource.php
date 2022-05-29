<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LotResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'user_id' => $this['user_id'],
            'item_id' => $this['item_id'],
            'count' => $this['count'],
        ];
    }
}