<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\UserListRequest;
use App\Http\Requests\V1\RouteIdRequest;
use App\Http\Requests\V1\UserUpdateRequest;
use App\Http\Resources\V1\UserCollection;
use App\Http\Responses\V1\ApiResponse;
use App\Http\Resources\V1\UserResource;
use App\Services\V1\User\UserServiceContract;
use JsonException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @throws JsonException
     */
    public function list(UserListRequest $request, UserServiceContract $userService): ApiResponse
    {
        $apiListingDto = $userService->list($request->toDto());
        $response      = new ApiResponse(UserCollection::make($apiListingDto->collection));

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
     * Display the specified resource.
     *
     * @throws JsonException
     */
    public function show(int $id, RouteIdRequest $request, UserServiceContract $userService): ApiResponse
    {
        $response = new ApiResponse(UserResource::make(
            $userService->show($id)
        ));

        return $response->format();
    }

    /**
     * Update the specified resource in storage.
     *
     * @throws JsonException
     */
    public function update(UserUpdateRequest $request, UserServiceContract $userService)
    {
        $response = new ApiResponse(UserResource::make(
            $userService->update($request->toDto())
        ));

        return $response->format();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id, RouteIdRequest $request, UserServiceContract $userService): Void
    {
        $userService->destroy($id);

        response()->noContent();
    }
}
