<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Contracts\Validation\Validator;

class UserRequest extends FormRequest
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
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
            'type' => 'required',
            'dob' => '',
            'address' => '',
            'phone'=> '',
            'profile' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

            /**
     * This is to response JSON if fail validations.
     * @param Validator $validator
     * @return json error object
     */
    protected function failedValidation(Validator $validator)
    {
      $errors = $validator->errors();

        throw new HttpResponseException(
            response()->json(['errors' => $errors], JsonResponse::HTTP_UNPROCESSABLE_ENTITY)
        );
    }
}
