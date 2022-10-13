<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
           'category_id'=>'required|numeric',
           'product_name'=>'required|string|max:255',
           'product_price'=>'required|numeric|min:0',
           'product_code'=>'required|string|unique:products,product_code',
           'product_stock'=>'required|numeric|min:1',
           'product_qty'=>'required|numeric|min:1',
           'short_description'=>'required|string',
           'long_description'=>'required|string',
           'additional_info'=>'required|string',
           'product_image'=>'required|image|max:1024',
        ];
    }
}
