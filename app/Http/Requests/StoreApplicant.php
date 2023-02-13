<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicant extends FormRequest
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
        switch($this->request->get('step')){
            case 1:
                return [
                    'identification' => 'required',
                    'firstname' => 'required',
                    'lastname' => 'required',
                    'email' => 'required|email',
                    'image' => 'required|image',
                    'title' => 'required',
                    'aboutme'=> 'required',
                    'location' => 'required',
                    'phone' => 'required',
                    'cv' => 'required|mimes:pdf',
                ];
            break;

            case 2:
            case 3: 
            case 4:
                return [];
            break;

        }
        dd();
        
    }
}
