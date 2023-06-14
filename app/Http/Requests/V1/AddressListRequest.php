<?php

namespace App\Http\Requests\V1;

use App\Dto\Address\AddressListDto;
use Illuminate\Foundation\Http\FormRequest;

class AddressListRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'limit'      => ['sometimes', 'integer', 'max:' . config('limits.customer_limit')],
            'street'     => ['sometimes', 'string'],
            'city'       => ['sometimes', 'string'],
            'state'      => ['sometimes', 'string'],
            'postalCode' => ['sometimes', 'string'],
        ];
    }

    public function toDto(): AddressListDto
    {
        return new AddressListDto(
            limit: $this->get('limit', config('limits.customer_limit')),
            street:$this->get('address'),
            city: $this->get('city'),
            state: $this->get('state'),
            postalCode: $this->get('postalCode'),
        );
    }
}
