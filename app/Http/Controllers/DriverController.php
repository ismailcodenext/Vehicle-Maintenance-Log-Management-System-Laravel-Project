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
            $user_id = Auth::id();
            $img = $request->file('image');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $image = "uploads/driver-img/{$img_name}";
            $img->move(public_path('/uploads/driver-img'), $img_name);

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
            $user_id = Auth::id();
            $img = $request->file('image');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $image = "uploads/driver-img/{$img_name}";
            $img->move(public_path('/uploads/driver-img'), $img_name);

            $Driver_update = Driver::find($request->input('id'));
            $Driver_update->full_name = $request->input('full_name');
            $Driver_update->license_number = $request->input('license_number');
            $Driver_update->phone = $request->input('phone');
            $Driver_update->email = $request->input('email');
            $Driver_update->address = $request->input('address');
            $Driver_update->date_of_birth = $request->input('date_of_birth');
            $Driver_update->license_expiry_date = $request->input('license_expiry_date');
            $Driver_update->medical_clearance_status = $request->input('medical_clearance_status');
            $Driver_update->driving_history = $request->input('driving_history');
            $Driver_update->image = $image;
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
