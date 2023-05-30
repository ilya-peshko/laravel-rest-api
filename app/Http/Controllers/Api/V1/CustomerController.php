<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Services\CustomerServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CustomerListRequest;
use App\Http\Requests\V1\RouteIdRequest;
use App\Http\Requests\V1\CustomerStoreRequest;
use App\Http\Requests\V1\CustomerUpdateRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Responses\V1\ApiResponse;
use App\Http\Resources\V1\CustomerResource;
use JsonException;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @throws JsonException
     */
    public function list(CustomerListRequest $request, CustomerServiceContract $customerService): ApiResponse
    {
        $apiListingDto = $customerService->list($request->toDto());
        $response      = new ApiResponse(CustomerCollection::make($apiListingDto->collection));

        $response->addMeta([
            'lastPage' => $apiListingDto->lastPage,
            'total'    => $apiListingDto->total,
            'perPage'  => $apiListingDto->count,
        ]);

        return $response->format();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @throws JsonException
     */
    public function store(CustomerStoreRequest $request, CustomerServiceContract $customerService): ApiResponse
    {
        $response = new ApiResponse(CustomerResource::make(
            $customerService->store($request->toDto())
        ));

        return $response->format();
    }

    /**
     * Display the specified resource.
     *
     * @throws JsonException
     */
    public function show(RouteIdRequest $request, CustomerServiceContract $customerService): ApiResponse
    {
        $response = new ApiResponse(CustomerResource::make(
            $customerService->show($request->id)
        ));

        return $response->format();
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws JsonException
     */
    public function update(CustomerUpdateRequest $request, CustomerServiceContract $customerService)
    {
        $response = new ApiResponse(CustomerResource::make(
            $customerService->update($request->toDto())
        ));

        return $response->format();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @throws JsonException
     */
    public function destroy(RouteIdRequest $request, CustomerServiceContract $customerService): ApiResponse
    {
        $response  = new ApiResponse();
        $isDeleted = $customerService->destroy($request->id);

        if ($isDeleted) {
            $response->addMessage(__('messages.customer_deleted', ['id' => $request->id]));
        } else {
            $response->addError(__('messages.customer_not_deleted', ['id' => $request->id]))
                ->setStatusCode(Response::HTTP_BAD_REQUEST);
        }

        return $response->format();
    }
}
