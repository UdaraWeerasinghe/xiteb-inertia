<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuetationStoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [
            'prescription_id' => 'required|exists:prescriptions,id|unique:quetations,prescription_id',
            'products' => 'required|array',
            'products.*.id' => 'required|exists:products,id',
            'products.*.qty' => 'required|numeric',
        ];
    }
}
