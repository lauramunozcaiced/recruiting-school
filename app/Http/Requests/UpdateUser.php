<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUser extends FormRequest
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
        if($this->request->get('password') != ''){
        return [
            'name' => ['required', 'string', 'max:255'],
            'role' =>['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
        }else{
            return [
                'name' => ['required', 'string', 'max:255'],
                'role' =>['required'],
            ];
        }
    }
}
