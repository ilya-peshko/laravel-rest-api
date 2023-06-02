<?php

namespace App\Services\V1;

use App\Contracts\Repositories\RegistrationRepositoryContract;
use App\Contracts\Services\AuthorizationServiceContract;
use App\Dto\Authorization\AuthDto;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

final class AuthorizationService implements AuthorizationServiceContract
{
    public function __construct(
        private readonly RegistrationRepositoryContract $registrationRepository
    ) {
    }

    public function register(AuthDto $dto): string
    {
        $dto = new AuthDto(
            name: $dto->name,
            email: $dto->email,
            password: Hash::make($dto->password),
        );

        $user = $this->registrationRepository->create($dto);

        return $user->createToken('basic-token', ['server:update', 'server:create', 'server:delete'])->plainTextToken;
    }

    /**
     * @throws AuthenticationException
     */
    public function login(AuthDto $dto): string
    {
        $credentials = $dto->toArray($dto);

        if (!Auth::attempt($credentials)) {
            throw new AuthenticationException('Bad credentials');
        }

        $user = Auth::user();
        $user->tokens()->delete();

        return $user->createToken('basic-token', ['server:update', 'server:store', 'server:destroy'])->plainTextToken;
    }
}
