<?php

namespace App\Http\Requests\V1;

use App\Dto\Customer\CustomerUpdateDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && $user->tokenCan('server:update');
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
                'id'         => ['required', 'integer', Rule::exists('customers', 'id')],
                'name'       => ['required'],
                'type'       => ['required', Rule::in(['Individual', 'Business', 'individual', 'business'])],
                'email'      => ['required', 'email'],
                'address'    => ['required'],
                'city'       => ['required'],
                'state'      => ['required'],
                'postalCode' => ['required'],
            ];
        } else {
            return [
                'id'         => ['required', 'integer', Rule::exists('customers', 'id')],
                'name'       => ['sometimes'],
                'type'       => ['sometimes', Rule::in(['Individual', 'Business', 'individual', 'business'])],
                'email'      => ['sometimes', 'email'],
                'address'    => ['sometimes'],
                'city'       => ['sometimes'],
                'state'      => ['sometimes'],
                'postalCode' => ['sometimes'],
            ];
        }
    }

    public function toDto(): CustomerUpdateDto
    {
        return new CustomerUpdateDto(
            id: $this->get('id'),
            name: $this->get('name'),
            type: $this->get('type'),
            email: $this->get('email'),
            address: $this->get('address'),
            city: $this->get('city'),
            state: $this->get('state'),
            postalCode: $this->get('postalCode'),
        );
    }
}
