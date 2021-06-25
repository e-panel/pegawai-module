<?php

namespace Modules\Pegawai\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonilRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'nip' => 'required', 
            'nama' => 'required', 
            'foto' => 'mimes:jpg,jpeg,png'
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}
