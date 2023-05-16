<?php

namespace App\Http\Controllers\Api\V1;

use App\Contracts\Services\CustomerServiceContract;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\CustomerListRequest;
use App\Http\Requests\V1\CustomerStoreRequest;
use App\Http\Requests\V1\CustomerUpdateRequest;
use App\Http\Resources\V1\CustomerCollection;
use App\Http\Responses\V1\ApiResponse;
use App\Http\Resources\V1\CustomerResource;
use App\Models\Customer;
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
        $response = new ApiResponse(CustomerCollection::make(
            $customerService->list($request->toDto())
        ));

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
    public function show(int $id, CustomerServiceContract $customerService): ApiResponse
    {
        $response = new ApiResponse(CustomerResource::make(
            $customerService->show($id)
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
    public function destroy(int $id, CustomerServiceContract $customerService): ApiResponse
    {
        $response = new ApiResponse();
        $customerService->destroy($id);

        return $response
            ->addMessage("Customer {$id} deleted successfully")
            ->format();
    }
}
