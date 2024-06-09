<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
                'name' => $request->input('name'),
                'group' => $request->input('group')
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
            $user_id = Auth::id();
            $request->validate(["id" => 'required|string']);

            $rows = Permission::where('id', $request->input('id'))->first();
            return response()->json([
                'status' => 'success',
                'rows' => $rows
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function permissionUpdate(Request $request)
    {
        try {
            $permission_Update = Permission::find($request->input('id'));
            $permission_Update->name = $request->input('name');
            $permission_Update->save();

            return response()->json([
               'status' => 'success',
                'message' => 'Permission updated successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
               'status' => 'fail',
                'message' => $e->getMessage()
            ]);
        }

    }

    public function permissionDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $Permission_Delete_Id = $request->input('id');
            $PermissionDelete = Permission::find($Permission_Delete_Id);

            if (!$PermissionDelete) {
                return response()->json([
                   'status' => 'fail',
                   'message' => 'Permission not found'
                ]);
            }

            Permission::where('id', $Permission_Delete_Id)->delete();
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
