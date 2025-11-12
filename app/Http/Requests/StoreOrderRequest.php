<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'user_id' => 'required|exists:users,id',
            'total_price' => 'required|numeric',
            'order_date' => 'sometimes|date',
            'order_details' => 'required|array',
            'order_details.*.product_id' => 'required|exists:products,id',
            'order_details.*.original_price' => 'required|numeric',
            'order_details.*.final_price' => 'required|numeric',
            'order_details.*.quantity' => 'required|integer',
        ];
    }
}
