<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Models\Permission;
use App\Repositories\UserRepository;

class PermissionUserController extends Controller
{
     public function __construct(private UserRepository $userRepository)
    {

    }


    // Sync permissions of a user
    public function syncPermissionsOfUser(Request $request, string $id)
    {
        $response = $this->userRepository->syncPermissions($id, $request->permissions);
        if (!$response) {
            return response()->json(['message' => 'Failed to sync permissions'], 400);
        }
          return response()->json(['message' => 'Permissions synced successfully'], 200);
    }


    public function getPermissionOfUser(string $id)
    {

        if (!$this->userRepository->findById($id)) {
            return response()->json(['message' => 'Failed to sync permissions'], 400);
        }

        $permissions = $this->userRepository->getPermissionsByUserId($id);
          return  Permission::collection($permissions);
    }


}
