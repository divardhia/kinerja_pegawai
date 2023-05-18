<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNilaiRequest extends FormRequest
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
            'c2' => ['required', 'min:0', 'max:120'],
            'c3' => ['required', 'min:0', 'max:120'],
            'c4' => ['required', 'min:0', 'max:120'],
            'c5' => ['required', 'min:0', 'max:120']
        ];
    }

    public function messages()
    {
        return [
            'c2.required' => "Kriteria 2 harus diisi!",
            'c2.min'      => "Kriteria 2 minimal nilai harus 0",
            'c2.max'      => "Kriteria 2 maksimal nilai harus 120",

            'c3.required' => "Kriteria 3 harus diisi!",
            'c3.min'      => "Kriteria 3 minimal nilai harus 0",
            'c3.max'      => "Kriteria 3 maksimal nilai harus 120",

            'c4.required' => "Kriteria 4 harus diisi!",
            'c4.min'      => "Kriteria 4 minimal nilai harus 0",
            'c4.max'      => "Kriteria 4 maksimal nilai harus 120",

            'c5.required' => "Kriteria 5 harus diisi!",
            'c5.min'      => "Kriteria 5 minimal nilai harus 0",
            'c5.max'      => "Kriteria 5 maksimal nilai harus 120",
        ];
    }
}
