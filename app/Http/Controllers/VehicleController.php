<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VehicleController extends Controller
{
    public function VehiclesList(){
        try {
            $Vehicles_list = Vehicle::with(['category', 'driver'])->get();
            return response()->json(['status' => 'success', 'vehicles_data' => $Vehicles_list]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    public function ActiveVehiclesList()
    {
        try {
            $driver_data = Vehicle::where('status', 'Active')->get();
            return response()->json(['status' => 'success', 'Driver_data' => $driver_data]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    public function VehicleCreate(Request $request)
    {
        try {
            $request->validate([
                'brand' => 'required|string|max:255',
                'model' => 'required|string|max:255',
                'year' => 'required|integer|digits:4',
                'vin' => 'required|string|unique:vehicles,vin',
                'license_plate' => 'required|string|max:10|unique:vehicles,license_plate',
                'color' => 'required|string|max:50',
                'mileage' => 'required|integer',
                'purchase_date' => 'required|date',
                'history' => 'nullable|string',
                'status' => 'required|string|max:50'
            ]);

            // Create new Vehicle
            $user_id = Auth::id();
            Vehicle::create([
                'user_id' => $user_id,
                'vehicle_category_id' => $request->category,
//                'driver_id' => $request->driver,
                'brand' => $request->brand,
                'model' => $request->model,
                'year' => $request->year,
                'vin' => $request->vin, // Removed the extra space here
                'license_plate' => $request->license_plate, // Corrected the field name
                'color' => $request->color,
                'mileage' => $request->mileage,
                'purchase_date' => $request->purchase_date,
                'history' => $request->history,
                'status' => $request->status
            ]);

            return response()->json(['status' => 'success', 'message' => 'Vehicle created successfully']);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function VehicleById(Request $request){
        try {
            $request->validate(["id" => 'required|string']);

            $rows = Vehicle::where('id', $request->input('id'))->first();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function VehiclesUpdate(Request $request)
    {
        try {
            Vehicle::where('id', $request->input('id'))->update([
                'id' => $request->id, // Added the id field here
                'vehicle_category_id' => $request->category,
                'driver_id' => $request->driver,
                'brand' => $request->brand,
                'model' => $request->model,
                'year' => $request->year,
                'vin' => $request->vin, // Removed the extra space here
                'license_plate' => $request->license_plate, // Corrected the field name
                'color' => $request->color,
                'mileage' => $request->mileage,
                'purchase_date' => $request->purchase_date,
                'history' => $request->history,
                'status' => $request->status
            ]);

            return response()->json(['status' => 'success', 'message' => 'Vehicle Update Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function VehiclesDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $VehiclesCategory = Vehicle::find($request->input('id'));

            if (!$VehiclesCategory) {
                return response()->json(['status' => 'fail', 'message' => 'VehiclesCategory not found.']);
            }
            Vehicle::where('id', $request->input('id'))->delete();

            return response()->json(['status' => 'success', 'message' => 'VehiclesCategory Delete Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
