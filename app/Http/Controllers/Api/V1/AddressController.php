<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\AddressListRequest;
use App\Http\Resources\V1\AddressCollection;
use App\Http\Responses\V1\ApiResponse;
use App\Services\V1\Address\AddressServiceContract;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function list(AddressListRequest $request, AddressServiceContract $addressService): ApiResponse
    {
        $apiListingDto = $addressService->list($request->toDto());
        $response      = new ApiResponse(AddressCollection::make($apiListingDto->collection));

        $response->addMeta([
            'lastPage'    => $apiListingDto->lastPage,
            'total'       => $apiListingDto->total,
            'perPage'     => $apiListingDto->count,
            'nextPageUrl' => $apiListingDto->nextPageUrl,
            'prevPageUrl' => $apiListingDto->prevPageUrl,
        ]);

        return $response->format();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): Response
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): Response
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): Response
    {

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): Response
    {

    }
}
