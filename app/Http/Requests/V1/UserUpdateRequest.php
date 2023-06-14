<?php

namespace App\Http\Requests\V1;

use App\Dto\User\UserUpdateDto;
use App\Enums\UserTypesEnum;
use App\Enums\TokenAbilitiesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && $user->tokenCan(TokenAbilitiesEnum::Update->value);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method === Request::METHOD_PUT) {
            return [
                'id'         => ['required', 'integer', Rule::exists('users', 'id')],
                'type'       => ['required', Rule::in([UserTypesEnum::Individual->value, UserTypesEnum::Business->value])],
                'address'    => ['required'],
                'city'       => ['required'],
                'state'      => ['required'],
                'postalCode' => ['required'],
            ];
        } else {
            return [
                'id'         => ['required', 'integer', Rule::exists('users', 'id')],
                'type'       => ['sometimes', Rule::in([UserTypesEnum::Individual->value, UserTypesEnum::Business->value])],
                'address'    => ['sometimes'],
                'city'       => ['sometimes'],
                'state'      => ['sometimes'],
                'postalCode' => ['sometimes'],
            ];
        }
    }

    public function toDto(): UserUpdateDto
    {
        return new UserUpdateDto(
            id: $this->get('id'),
            type: $this->get('type'),
            firstName: $this->get('firstName'),
            lastName: $this->get('lastName'),
            email: $this->get('email'),
        );
    }
}
