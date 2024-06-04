<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\VehicleAssignedToDriver;

class VehicleAssignedToDriveController extends Controller
{
    public function VehicleAssignedToDriverList()
    {
        try {
            $user_id = Auth::id();
            $driver_data = VehicleAssignedToDriver::with('vehicle', 'driver')->where('user_id', $user_id)->get();
            return response()->json(['status' => 'success', 'Driver_data' => $driver_data]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    public function VehicleAssignedToDriverCreate(Request $request)
    {
        try {

            $user_id = Auth::id();

            $request->validate([
                'vehicle_id' => 'required|string|exists:vehicles,id',
                'driver_id' => 'required|string|exists:drivers,id',
                'date' => 'required|date',
                'status' => 'required|in:Active,Pending',
            ]);

            VehicleAssignedToDriver::create([
                'vehicle_id' => $request->input('vehicle_id'),
                'driver_id' => $request->input('driver_id'),
                'date' => $request->input('date'),
                'status' => $request->input('status'),
                'user_id' => $user_id
            ]);

            return response()->json(['status' => 'success', 'message' => 'Vehicle Assigned to Driver successfully']);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function VehicleAssignedToDriverById(Request $request)
    {
        try {
            $user_id = Auth::id();
            $request->validate(["id" => 'required|string']);

            $rows = VehicleAssignedToDriver::where('id', $request->input('id'))->where('user_id', $user_id)->first();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function VehicleAssignedToDriverUpdate(Request $request)
    {
        try {
            $id = $request->input('id');
            $user_id = Auth::id();
            $vehicle_assigned_to_driver_update = VehicleAssignedToDriver::find($id);
            $request->validate([
                'vehicle_id' => 'required|string|exists:vehicles,id',
                'driver_id' => 'required|string|exists:drivers,id',
                'date' => 'required|date',
                'status' => 'required|in:Active,Pending'
            ]);

            $vehicle_assigned_to_driver_update->vehicle_id = $request->input('vehicle_id');
            $vehicle_assigned_to_driver_update->driver_id = $request->input('driver_id');
            $vehicle_assigned_to_driver_update->date = $request->input('date');
            $vehicle_assigned_to_driver_update->status = $request->input('status');
            $vehicle_assigned_to_driver_update->user_id = $user_id;

            $vehicle_assigned_to_driver_update->save();
            return response()->json(['status' => 'success', 'message' => 'vehicle driver Update Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }



    function VehicleAssignedToDriverDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $vehicle_assigned_to_driver_delete_id = $request->input('id');
            $vehicle_assigned_to_driver_delete = VehicleAssignedToDriver::find($vehicle_assigned_to_driver_delete_id);

            if (!$vehicle_assigned_to_driver_delete) {
                return response()->json(['status' => 'fail', 'message' => 'Driver not found.']);
            }
            VehicleAssignedToDriver::where('id', $vehicle_assigned_to_driver_delete_id)->delete();

            return response()->json(['status' => 'success', 'message' => 'Assigned Driver Data Delete Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
