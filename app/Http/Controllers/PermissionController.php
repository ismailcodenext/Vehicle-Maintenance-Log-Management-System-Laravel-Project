<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //Permission List
    public function permissionList()
    {
        try {
            $permissions = Permission::get();
            return response()->json([
                'status' => 'success',
                'permissions' => $permissions
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function permissionCreate(Request $request)
    {
        try {
            Permission::create([
                'name' => $request->input('name')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Permission created successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function permissionById(Request $request)
    {
        try {
//           ensure the user is authenticated
            $user_id = Auth::id();

//          Validate the incoming request
            $request->validate([
                'id' => 'required|string'
            ]);

//          check if the user has permission to view this permission
            $permission = Permission::where('id', $request->input('id'))
                ->where('user_id', $user_id)
                ->first();

            if ($permission) {
                return response()->json([
                   'status' => 'success',
                   'permission' => $permission
                ]);
            } else {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Permission not found or access denied!'
                ]);
            }
        } catch (Exception $e) {
            return response()->json([
               'status' => 'fail',
               'message' => $e->getMessage()
            ]);
        }
    }

    public function permissionUpdate(Request $request, $permission, $id)
    {
        try {
            $user_id = Auth::id();
            $request->validate([
               'name' => 'required|string|unique:permissions,name,' . $id,
            ]);

            $permission->update([
                'name' => $request->input('name')
            ]);

            return response()->json([
               'status' => ('success'),
               'message' => 'Permission updated successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function permissionDelete(Permission $permission)
    {
        try {
            $permission->delete();
            return response()->json([
               'status' => 'success',
               'message' => 'Permission deleted successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage()
            ]);
        }
    }

}
