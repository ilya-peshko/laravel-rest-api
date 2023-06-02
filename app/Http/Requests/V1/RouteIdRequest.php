<?php

namespace App\Http\Requests\V1;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Request;

class RouteIdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();

        return $this->method() === Request::METHOD_GET || ($user !== null && $user->tokenCan('server:destroy'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => ['required' , 'integer'],
        ];
    }

    public function prepareForValidation(): void
    {
        $this->merge($this->route()->parameters());
    }
}
