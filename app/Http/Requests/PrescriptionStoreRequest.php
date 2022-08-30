<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PrescriptionStoreRequest extends FormRequest
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
            'images' => 'array',
            'note' => 'required|string|max:200|min:3',
            'delivery_address' => 'required|string|max:200|min:3',
            'delivery_date' => 'required|date|date_format:Y-m-d|after:today',
            'delivery_time_slot' => 'required|string|max:20|min:5',
        ];
    }
}
