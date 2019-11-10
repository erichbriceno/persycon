<?php

namespace App\Http\Requests;

use App\Model\User;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'names' => ['required', 'string', 'max:255'],
            'surnames' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
            'role_id' => [
                'required',
                'present',
                Rule::exists('roles', 'id')->where('selectable', true),
            ],
            'management_id' => [
                'nullable',
                Rule::exists('managements', 'id')
            ],
            'password' => ['confirmed'],
            'password_confirmation' => ['same:password'],
            'state' => [
                Rule::in(['active','inactive'])
            ]
        ];
    }

    public function updateUser(User $user)
    {
        //dd($this->state == 'active');
        $user->fill([
            'names' => $this->names,
            'surnames' => $this->surnames,
            'email' => $this->email,
            'role_id' => $this->role_id,
            'management_id' => $this->management_id,
            'active' => $this->state == 'active'
        ]);
        if ($this->password != null) {
            $user->password = bcrypt($this->password);
        }
        $user->save();

    }
}
