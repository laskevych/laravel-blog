<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\User;

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
        return [
            'name' => 'required', 'string', 'max:255',
            'locale' => [
                'required', 
                'string', 
                'max:3',
                Rule::in(array_keys(User::LOCALES))
            ],
            'avatar' => 'image|mimes:jpg,jpeg,png|max:1024|dimensions:max_width=250,max_height=250'
        ];
    }
}
