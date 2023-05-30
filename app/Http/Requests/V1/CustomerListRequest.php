<?php

namespace App\Http\Requests\V1;

use App\Dto\Customer\CustomerListDto;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CustomerListRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'limit'           => ['sometimes', 'integer', 'max:'.config('limits.customer_limit')],
            'name'            => ['sometimes', 'string'],
            'type'            => ['sometimes', Rule::in(['Individual', 'Business', 'individual', 'business'])],
            'email'           => ['sometimes', 'email'],
            'address'         => ['sometimes', 'string'],
            'city'            => ['sometimes', 'string'],
            'state'           => ['sometimes', 'string'],
            'postalCode'      => ['sometimes', 'string'],
            'includeInvoices' => ['sometimes', 'bool'],
        ];
    }

    public function toDto(): CustomerListDto
    {
        return new CustomerListDto(
            limit: $this->get('limit', config('limits.customer_limit')),
            name: $this->get('name'),
            type: $this->get('type'),
            email: $this->get('email'),
            address: $this->get('address'),
            city: $this->get('city'),
            state: $this->get('state'),
            postalCode: $this->get('postalCode'),
            includeInvoices: $this->get('includeInvoices', false),
        );
    }
}
