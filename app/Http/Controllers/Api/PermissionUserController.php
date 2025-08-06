<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;

class PermissionUserController extends Controller
{
     public function __construct(private UserRepository $userRepository)
    {

    }

    public function syncPermissionsOfUser(Request $request, string $id)
    {
        $response = $this->userRepository->syncPermissions($id, $request->permissions);
        if (!$response) {
            return response()->json(['message' => 'Failed to sync permissions'], 400);
        }
          return response()->json(['message' => 'Permissions synced successfully'], 200);
    }

}