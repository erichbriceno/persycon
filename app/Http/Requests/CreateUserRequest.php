<?php

namespace App\Http\Requests;

use App\Model\User;
use App\Rules\CeduleExist;
use App\Rules\UserExist;
use App\Rules\ValidCedule;
use Illuminate\Support\Str;
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
            'cedule' => [
                'required',
                new ValidCedule,
                new CeduleExist,
                new UserExist,
            ],
            'names' => ['required', 'present','string', 'max:255'],
            'surnames' => ['required', 'present','string', 'max:255'],
            'email' => ['required', 'present', 'string', 'email', 'max:255', 'unique:users'],
            'role' => [
                'required',
                'present',
                Rule::exists('roles', 'id')->where('selectable', true),
            ],
            'management' => [
                'nullable',
                 Rule::exists('managements', 'id')->where('selectable', true)
            ],
            'password' => ['required', 'string', 'min:6','confirmed'],
            'password_confirmation' => ['required','min:6','same:password'],
            'state' => [
                'required',
                Rule::in(['active','inactive'])
            ]
        ];
    }

    public function messages()
    {
        return [
            'role_id.rule' => 'El rol es inválido.',
        ];
    }

    public function createUser()
    {

        $user = User::create([
            'nat' => Str::substr($this->cedule, 0, 1),
            'numberced' => Str::substr($this->cedule, 1, 8),
            'names' => $this->names,
            'surnames' => $this->surnames,
            'email' => Str::lower($this->email),
            'role_id' => $this->role,
            'management_id' => $this->management,
            'password' => bcrypt($this->password),
            'active' => $this->state == 'active'
            ]);

        $user->save();
    }
}
