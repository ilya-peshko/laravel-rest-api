<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Services\CustomerServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CustomerListRequest;
use App\Http\Requests\RouteIdRequest;
use App\Http\Requests\V1\CustomerStoreRequest;
use App\Http\Requests\V1\CustomerUpdateRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Responses\V1\ApiResponse;
use App\Http\Resources\V1\CustomerResource;
use JsonException;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @throws JsonException
     */
    public function list(CustomerListRequest $request, CustomerServiceContract $customerService): ApiResponse
    {
        $dto = $request->toDto();

        $collection = $customerService->list($dto);
        $response   = new ApiResponse(CustomerCollection::make($collection));

        $response->addMeta([
            'limit'       => $dto->limit,
            'currentPage' => $dto->pageNumber,
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
        $response = new ApiResponse();
        $customerService->destroy($request->id);

        return $response
            ->addMessage(__('messages.customer_deleted', ['id' => $request->id]))
            ->format();
    }
}
