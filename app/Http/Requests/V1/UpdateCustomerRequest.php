<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Symfony\Component\HttpFoundation\Request;

class UpdateCustomerRequest extends FormRequest
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
        $method = $this->method();

        if ($method === Request::METHOD_PUT) {
            return [
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
                'name'       => ['sometimes', 'required'],
                'type'       => ['sometimes', 'required', Rule::in(['Individual', 'Business', 'individual', 'business'])],
                'email'      => ['sometimes', 'required', 'email'],
                'address'    => ['sometimes', 'required'],
                'city'       => ['sometimes', 'required'],
                'state'      => ['sometimes', 'required'],
                'postalCode' => ['sometimes', 'required'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->postalCode) {
            $this->merge([
                'postal_code' => $this->postalCode,
            ]);
        }
    }
}