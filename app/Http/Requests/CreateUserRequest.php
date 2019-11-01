<?php

namespace App\Http\Requests;

use App\Model\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'first_name' => ['required', 'present','string', 'max:255'],
            'last_name' => ['required', 'present','string', 'max:255'],
            'email' => ['required', 'present', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'role_id' => [
                'required',
                'present',
                Rule::exists('roles', 'id')->where('selectable', true),
            ]
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es',
        ];
    }

    public function createUser()
    {
        //DB::trasaction(function () {
            $data = $this->validated();
            User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => bcrypt($data['password']),
                'role_id' => $data['role_id']
            ]);
        //});
    }
}
