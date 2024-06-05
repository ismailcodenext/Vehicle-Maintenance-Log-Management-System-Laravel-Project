<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\ServiceProvider;
use Illuminate\Support\Facades\Auth;

class ServiceProviderController extends Controller
{
    public function ServiceProviderList()
    {
        try {
            $user_id = Auth::id();
            $ServiceProvider_data = ServiceProvider::where('user_id', $user_id)->get();
            return response()->json(['status' => 'success', 'ServiceProvider_data' => $ServiceProvider_data]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    public function ServiceProviderCreate(Request $request)
    {
        try {
            // Get authenticated user's ID
            $user_id = Auth::id();
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|string|email|unique:service_providers,email',
                'phone' => 'required|string|unique:service_providers,phone',
                'address' => 'required|string',
                'status' => 'required|in:Active,Pending'
            ]);

            // Create new ServiceProvider
            ServiceProvider::create([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'status' => $request->input('status'),
                'user_id' => $user_id
            ]);

            return response()->json(['status' => 'success', 'message' => 'Service Provider created successfully']);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function ServiceProviderById(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate(["id" => 'required|string']);

            $rows = ServiceProvider::where('id', $request->input('id'))->where('user_id', $user_id)->first();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function ServiceProviderUpdate(Request $request)
    {
        try {
            $user_id = Auth::id();
            $id = $request->input('id');
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'nullable|string|email|unique:service_providers,email,' . $id,
                'phone' => 'required|string|unique:service_providers,phone,' . $id,
                'address' => 'required|string',
                'status' => 'required|in:Active,Pending'
            ]);
            $ServiceProvider_Update = ServiceProvider::find($id);
            $ServiceProvider_Update->name = $request->input('name');
            $ServiceProvider_Update->email = $request->input('email');
            $ServiceProvider_Update->phone = $request->input('phone');
            $ServiceProvider_Update->address = $request->input('address');
            $ServiceProvider_Update->status = $request->input('status');
            $ServiceProvider_Update->user_id = $user_id;

            $ServiceProvider_Update->save();

            return response()->json(['status' => 'success', 'message' => 'Service Provider Update Successful']);
        } catch (Exception $e) {

            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function ServiceProviderDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $ServiceProvider_Delete_id = $request->input('id');
            $ServiceProviderDelete = ServiceProvider::find($ServiceProvider_Delete_id);

            if (!$ServiceProviderDelete) {
                return response()->json(['status' => 'fail', 'message' => 'Service Provider not found.']);
            }
            ServiceProvider::where('id', $ServiceProvider_Delete_id)->delete();

            return response()->json(['status' => 'success', 'message' => 'Service Provider Delete Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
