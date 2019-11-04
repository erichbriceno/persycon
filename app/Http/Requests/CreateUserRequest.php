<?php

namespace App\Http\Requests;

use App\Model\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'names' => ['required', 'present','string', 'max:255'],
            'surnames' => ['required', 'present','string', 'max:255'],
            'email' => ['required', 'present', 'string', 'email', 'max:255', 'unique:users'],
            'role_id' => [
                'required',
                'present',
                Rule::exists('roles', 'id')->where('selectable', true),
            ],
            'management_id' => [
                'nullable',
                Rule::exists('managements', 'id')
            ],
            'password' => ['required', 'string', 'min:6'],
            //'password-confirm' => ['required', 'string', 'min:6'],
        ];
    }

    public function messages()
    {
        return [
            'names.required' => 'El campo nombre es',
        ];
    }

    public function createUser()
    {
        //DB::trasaction(function () {
            $data = $this->validated();
            User::create([
                'names' => $data['names'],
                'surnames' => $data['surnames'],
                'email' => $data['email'],
                'role_id' => $data['role_id'],
                'management_id' => $data['management_id'],
                'password' => bcrypt($data['password'])
            ]);
        //});
    }
}
