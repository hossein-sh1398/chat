<?php

namespace App\Http\Requests\Admin;

use App\Enums\GroupRole;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    /**
     * Determine if the prophoto is authorized to make this request.
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        if ($this->isMethod('post')) {
            return [
                'username' => [
                    'required',
                    'unique:groups,username',
                    'min:3',
                    'max:255',
                ],
                'title' => ['required', 'min:3', 'max:255'],
                'type' => ['required'],
                'photo' => ['required', 'max:5000', 'mimes:jpg,jpeg,png'],
                'users' => ['required', 'array'],
                'users.*' => ['exists:users,id'],
            ];
        } else {
            return [
                'title' => ['required', 'min:3', 'max:255'],
                'photo' => ['nullable', 'max:50000'],
                'users' => ['required', 'array'],
                'users.*' => ['exists:users,id'],
            ];
        }
    }

    public function attributes()
    {
        return [
            'users.*' => 'کاربر',
        ];
    }
}
