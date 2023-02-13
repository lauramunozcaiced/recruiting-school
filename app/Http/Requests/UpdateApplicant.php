<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Input;

class UpdateApplicant extends FormRequest
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
        $visible = $this->request->get('visible');
        
        if(isset($visible)){
            return [];
        }
        else{
            switch($this->request->get('step')){
                case 1: 
                    return [
                        'identification' => 'required',
                        'firstname' => 'required',
                        'lastname' => 'required',
                        'email' => 'required|email',
                        'image' => 'image',
                        'title' => 'required',
                        'aboutme'=> 'required',
                        'location' => 'required',
                        'phone' => 'required',
                        'cv' => 'mimes:pdf',
                        'english'=> 'required'
                    ];
                break;

                case 2:
                case 3: 
                case 4: 
                    return [];
                break;

                case 5: 
                    return [
                        'position_id' => 'required'
                    ]; 
                break;

                case 6: 
                    return [
                        'video' => 'required'
                    ]; 
                break;
            }
        }
        
    
    }
}
