<?php

namespace App\Http\Requests\V1;

use App\Dto\User\UserListDto;
use App\Enums\UserTypesEnum;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UserListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'limit'           => ['sometimes', 'integer', 'max:'.config('limits.customer_limit')],
            'firstName'       => ['sometimes', 'string'],
            'lastName'        => ['sometimes', 'string'],
            'type'            => ['sometimes', Rule::in([UserTypesEnum::Individual->value, UserTypesEnum::Business->value])],
            'email'           => ['sometimes', 'email'],
            'street'          => ['sometimes', 'string'],
            'city'            => ['sometimes', 'string'],
            'state'           => ['sometimes', 'string'],
            'postalCode'      => ['sometimes', 'string'],
            'includeInvoices' => ['sometimes', 'bool'],
        ];
    }

    public function toDto(): UserListDto
    {
        return new UserListDto(
            limit: $this->get('limit', config('limits.customer_limit')),
            firstName: $this->get('firstName'),
            lastName: $this->get('lastName'),
            type: $this->get('type'),
            email: $this->get('email'),
            street: $this->get('address'),
            city: $this->get('city'),
            state: $this->get('state'),
            postalCode: $this->get('postalCode'),
            includeInvoices: $this->get('includeInvoices', false),
        );
    }
}
