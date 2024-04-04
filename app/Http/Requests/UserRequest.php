<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [

            'username' =>       ['required','string','max:255','unique:users'],
            'email' =>          ['required','string','email','max:255','unique:users'],
            'first_name' =>     ['required','string','max:255'],
            'last_name' =>      ['required','string','max:255'],
            "mobile_no" =>      ['required','regex:/[0-9]{11}/'],
            "occupation"	=>  ['required','string','max:50'],
            "education"	=>      ['required','string','max:50'],
            "country"	=>      ['required','string','max:255'],
            "city"	=>          ['required','string','max:255'],
            "area"	=>          ['required','string','max:255'],
            "sex"	=>          ['required','in:Male,Female'],
            "dob"	=>          ['date_format:Y-m-d','before:today'],
            'user_password' =>  ['min:8','required_with:password_confirm','same:password_confirm'],
            'password_confirm' => ['min:8']
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException( response()->json($validator->errors(), 422));
    }
}
