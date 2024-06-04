<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;


class RoleController extends Controller
{
    public function roleList()
    {
        try {
            $roles = Role::get();
            return response()->json([
                'status' => 'success',
                'roles' => $roles
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function roleCreate(Request $request)
    {
        try {
            Role::create([
                'name' => $request->input('name')
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Role created successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage()
            ]);
        }
    }

    public function roleById(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate([
                "id" => 'required|string'
            ]);

            $rows = Role::where('id', $request->input('id'))->first();
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

    public function roleUpdate(Request $request)
    {
        try {
            $role_Update = Role::find($request->input('id'));
            $role_Update->name = $request->input('name');
            $role_Update->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Role updated successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage()
            ]);
        }

    }

    public function roleDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $Role_Delete_Id = $request->input('id');
            $RoleDelete = Role::find($Role_Delete_Id);

            if (!$RoleDelete) {
                return response()->json([
                    'status' => 'fail',
                    'message' => 'Role not found'
                ]);
            }

            Role::where('id', $Role_Delete_Id)->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Role deleted successfully!'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'fail',
                'message' => $e->getMessage()
            ]);
        }
    }
}
