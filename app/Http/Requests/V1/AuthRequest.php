<?php

namespace App\Http\Requests\V1;

use App\Dto\Authorization\AuthDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AuthRequest extends FormRequest
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
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        if ($this->route()->getName() === 'register') {
            return [
                'name'       => ['required', 'string'],
                'email'      => ['required', 'email', 'unique:users'],
                'password'   => ['required', 'min:8'],
            ];
        }

        return [
            'email'      => ['required', 'email', Rule::exists('users', 'email')],
            'password'   => ['required', 'min:8'],
        ];
    }

    public function toDto(): AuthDto
    {
        return new AuthDto(
            name: $this->get('name'),
            email: $this->get('email'),
            password: $this->get('password'),
        );
    }
}
