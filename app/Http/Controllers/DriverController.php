<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DriverController extends Controller
{

    public function DriverList()
    {
        try {
            $driver_data = Driver::get();
            return response()->json(['status' => 'success', 'Driver_data' => $driver_data]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    public function DriverCreate(Request $request)
    {
        try {
            // Get authenticated user's ID

            $request->validate([
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|unique:drivers,phone',
                'email' => 'nullable|string|email|unique:drivers,email',
                'license_number' => 'required|string|max:10|unique:drivers,license_number',
                'address' => 'required|string',
                'date_of_birth' => 'required|date',
                'license_expiry_date' => 'required|date',
                'medical_clearance_status' => 'required|in:0,1',
                'driving_history' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required|in:Active,Pending'
            ]);
            $user_id = Auth::id();
            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $t = time();
                $file_name = $img->getClientOriginalName();
                $img_name = "{$t}-{$file_name}";
                $image = "uploads/driver-img/{$img_name}";
                $img->move(public_path('/uploads/driver-img'), $img_name);
            } else {
                $image = null;
            }

            // Create new Driver
            Driver::create([
                'full_name' => $request->input('full_name'),
                'license_number' => $request->input('license_number'),
                'phone' => $request->input('phone'),
                'email' => $request->input('email'),
                'address' => $request->input('address'),
                'date_of_birth' => $request->input('date_of_birth'),
                'license_expiry_date' => $request->input('license_expiry_date'),
                'medical_clearance_status' => $request->input('medical_clearance_status'),
                'driving_history' => $request->input('driving_history'),
                'image' => $image,
                'status' => $request->input('status'),
                'user_id' => $user_id
            ]);

            return response()->json(['status' => 'success', 'message' => 'Driver created successfully']);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function DriverById(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate(["id" => 'required|string']);

            $rows = Driver::where('id', $request->input('id'))->where('user_id', $user_id)->first();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function DriverUpdate(Request $request)
    {
        try {
            $id = $request->input('id');
            $user_id = Auth::id();
            $Driver_update = Driver::find($id);
            $request->validate([
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|unique:drivers,phone,' . $id,
                'email' => 'nullable|string|email|unique:drivers,email,' . $id,
                'license_number' => 'required|string|max:10|unique:drivers,license_number,' . $id,
                'address' => 'required|string',
                'date_of_birth' => 'required|date',
                'license_expiry_date' => 'required|date',
                'medical_clearance_status' => 'required|in:0,1',
                'driving_history' => 'required|string',
                'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'status' => 'required|in:Active,Pending'
            ]);
            if ($request->hasFile('image')) {
                $img = $request->file('image');
                $t = time();
                $file_name = $img->getClientOriginalName();
                $img_name = "{$t}-{$file_name}";
                $Driver_update->image = "uploads/driver-img/{$img_name}";
                $img->move(public_path('/uploads/driver-img'), $img_name);
            } else {
                $Driver_update->image = $request->input('image_url');
            }

            $Driver_update->full_name = $request->input('full_name');
            $Driver_update->license_number = $request->input('license_number');
            $Driver_update->phone = $request->input('phone');
            $Driver_update->email = $request->input('email');
            $Driver_update->address = $request->input('address');
            $Driver_update->date_of_birth = $request->input('date_of_birth');
            $Driver_update->license_expiry_date = $request->input('license_expiry_date');
            $Driver_update->medical_clearance_status = $request->input('medical_clearance_status');
            $Driver_update->driving_history = $request->input('driving_history');

            $Driver_update->status = $request->input('status');
            $Driver_update->user_id = $user_id;
            $Driver_update->save();
            return response()->json(['status' => 'success', 'message' => 'Driver Update Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }



    function DriverDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $Driver_Delete_id = $request->input('id');
            $DriverDelete = Driver::find($Driver_Delete_id);

            if (!$DriverDelete) {
                return response()->json(['status' => 'fail', 'message' => 'Driver not found.']);
            }
            Driver::where('id', $Driver_Delete_id)->delete();

            return response()->json(['status' => 'success', 'message' => 'Driver Delete Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
