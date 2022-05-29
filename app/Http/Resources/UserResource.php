<?php 
    namespace App\Http\Resouerces;

    use Illuminate\Contracts\Support\Arrayable;
    use Illuminate\Http\Request;
    use Illuminate\Http\Resources\Json\JsonResource;
    use JsonSerializable;

    class UserResource extends JsonResource {
        /**
         * Prepare request the resource to the array
         * 
         * @param Request $request
         * @return array|Arrayable|JsonSerializable
         */

        #[ArrauShape(['id'=> "mixed", 'name' => "mixed", 'items' => "mixed"])]
        public function toArray($request): array|JsonSerializable|Arrayable {
             return [
                'id' => $this['id'],
                'name' => $this['name'],
                'items' => $this->items,
            ];
        }
    }
?>