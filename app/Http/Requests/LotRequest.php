<?php 

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class LotRequest extends FormRequest {
    /**
     * @return bool
    */

    public function autorize(): bool {
        return true;
    }

    /**
     * get validation rules that 
     * @return array<string, mixed>
     */
    #[ArrayShape(['user_id' => "string", 'item_id' => "string", 'count' => "string"])] 
    public function rules():array {
        return [
            'user_id' => 'required|integer',
            'item_id' => 'required|integer',
            'count' => 'required|integer',
        ];
    }
}
?>