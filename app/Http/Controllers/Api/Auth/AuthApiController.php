<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\AuthApiRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\UserResource;


class AuthApiController extends Controller
{
     public function __construct(private UserRepository $userRepository)
    {

    }

    public function auth(AuthApiRequest $request)
    {

        $user = $this->userRepository->findByEmail($request->email);

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
         // Garantindo que não  terá acessos simultâneos
         $user->tokens()->delete();

         // Gerando o token de acesso
        $token = $user->createToken($request->device_name)->plainTextToken;
        return response()->json(['token' => $token]);
    }

    public function me()
    {
        // Retorna os dados do usuário autenticado
        $user = Auth::user();
        $user->load('permissions');
        return new UserResource($user);
        //return response()->json(['user' => Auth::user()]);
    }


    public function logout(Request $request)
{
    $request->user()->currentAccessToken()->delete();

    return response()->json(['message' => 'Logged out']);
}
}
