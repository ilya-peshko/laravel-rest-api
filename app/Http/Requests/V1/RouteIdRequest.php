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

        return $this->method() === Request::METHOD_GET || ($user !== null && $user->tokenCan('update'));
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

    /**
     * Get all of the input and files for the request.
     *
     * @param array|mixed|null $keys
     *
     * @return array
     */
    public function all($keys = null): array
    {
        return array_merge(
            parent::all($keys),
            $this->route()->parameters()
        );
    }
}
