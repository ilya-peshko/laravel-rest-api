<?php

namespace App\Exceptions;

use App\Http\Responses\V1\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use JsonException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $apiResponse = new ApiResponse();

        $this->renderable(function (ValidationException $e) use ($apiResponse) {
            return $apiResponse
                ->setStatusCode($e->status)
                ->setSuccess(false)
                ->addError($e->errors())
                ->format();
        });

        $this->renderable(function (NotFoundHttpException $e) use ($apiResponse) {
            return $apiResponse
                ->setStatusCode(Response::HTTP_NOT_FOUND)
                ->setSuccess(false)
                ->addError($e->getMessage() !== '' ? $e->getMessage() : __('exceptions.page_not_found'))
                ->format();
        });

        $this->renderable(function (ModelNotFoundException $e) use ($apiResponse) {
            return $apiResponse
                ->setStatusCode(Response::HTTP_NOT_FOUND)
                ->setSuccess(false)
                ->addError(__('exceptions.record_not_found'))
                ->format();
        });

        $this->renderable(function (InvalidArgumentException $e) use ($apiResponse) {
            return $apiResponse
                ->setStatusCode(Response::HTTP_BAD_REQUEST)
                ->setSuccess(false)
                ->addError($e->getMessage())
                ->format();
        });

        $this->renderable(function (JsonException $e) use ($apiResponse) {
            return $apiResponse
                ->setStatusCode(Response::HTTP_BAD_REQUEST)
                ->setSuccess(false)
                ->addError($e->getMessage())
                ->format();
        });

        $this->renderable(function (AuthenticationException $e) use ($apiResponse) {
            return $apiResponse
                ->setStatusCode(Response::HTTP_UNAUTHORIZED)
                ->setSuccess(false)
                ->addError($e->getMessage())
                ->format();
        });

        $this->renderable(function (Throwable $e) use ($apiResponse) {
            return $apiResponse
                ->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR)
                ->setSuccess(false)
                ->addError($e->getMessage())
                ->format();
        });
    }
}
