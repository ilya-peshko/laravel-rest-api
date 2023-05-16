<?php

namespace App\Http\Requests\V1;

use App\Dto\Customer\CustomerStoreDto;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class CustomerStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $user !== null && $user->tokenCan('create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'       => ['required'],
            'type'       => ['required', Rule::in(['Individual', 'Business', 'individual', 'business'])],
            'email'      => ['required', 'email'],
            'address'    => ['required'],
            'city'       => ['required'],
            'state'      => ['required'],
            'postalCode' => ['required'],
        ];
    }

    public function toDto(): CustomerStoreDto
    {
        return new CustomerStoreDto(
            name: $this->get('name'),
            type: $this->get('type'),
            email: $this->get('email'),
            address: $this->get('address'),
            city: $this->get('city'),
            state: $this->get('state'),
            postalCode: $this->get('postalCode'),
        );
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'postal_code' => $this->postalCode,
        ]);
    }
}
