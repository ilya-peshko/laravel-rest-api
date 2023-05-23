<?php

namespace App\Http\Responses\V1;

use JsonException;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiResponse extends JsonResponse
{
    protected array $errors   = [];
    protected array $messages = [];
    protected array $meta     = [];

    protected bool $success  = true;
    protected bool $redirect = false;

    /**
     * @throws JsonException
     */
    public function __invoke(): static
    {
        return $this->format();
    }

    /**
     * @param string $message
     *
     * @return ApiResponse
     */
    public function addMessage(string $message): self
    {
        $this->messages[] = $message;

        return $this;
    }

    /**
     * @param iterable $metaData
     *
     * @return ApiResponse
     */
    public function addMeta(iterable $metaData): self
    {
        foreach ($metaData as $key => $value) {
            $this->meta[$key] = $value;
        }

        return $this;
    }

    /**
     * @param bool $success
     *
     * @return ApiResponse
     */
    public function setSuccess(bool $success): self
    {
        $this->success = $success;

        return $this;
    }

    /**
     * @param string $token
     *
     * @return ApiResponse
     */
    public function setToken(string $token): self
    {
        $this->headers->set('Authorization', 'Bearer ' . $token);

        return $this;
    }

    /**
     * @return ApiResponse
     *
     * @throws JsonException
     */
    public function format(): ApiResponse
    {
        $data = [
            'data'     => json_decode($this->data, true, 512, JSON_THROW_ON_ERROR),
            'errors'   => $this->errors,
            'messages' => $this->messages,
            'meta'     => $this->meta,
            'success'  => $this->success,
        ];
        $this->setJson(json_encode($data, JSON_THROW_ON_ERROR | JSON_UNESCAPED_UNICODE));

        return $this;
    }

    /**
     * @param string|array $error
     *
     * @return ApiResponse
     */
    public function addError(string|array $error): self
    {
        $this->errors[] = $error;
        $this->success  = false;

        return $this;
    }

    /**
     * @param iterable $iterable
     *
     * @return ApiResponse
     */
    public function addErrors(iterable $iterable): self
    {
        foreach ($iterable as $error) {
            $this->addError($error);
        }

        return $this;
    }
}
