<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VehicleCategory;
use Exception;
use Illuminate\Support\Facades\Auth;

class VehiclesCategoryController extends Controller
{
    public function VehiclesCategoryList(){
        try {
            $Vehicles_category_list = VehicleCategory::get();
            return response()->json(['status' => 'success', 'vehicles_data' => $Vehicles_category_list]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    public function VehiclesCategoryCreate(Request $request)
    {
        try {
            $request->validate([
                'category_name' => 'required|string|max:50',
                'maximum_load_capacity' => 'required|integer',
                'seating_capacity' => 'required|integer'
            ]);
            // Create new Vehicles Catagory
            $user_id = Auth::id();
            VehicleCategory::create([
                'category_name' => $request->input('category_name'),
                'description' => $request->input('description'),
                'maximum_load_capacity' => $request->input('maximum_load_capacity'),
                'seating_capacity' => $request->input('seating_capacity'),
                'status'=>$request->input('status'),
                'user_id' => $user_id
            ]);

            return response()->json(['status' => 'success', 'message' => 'VehicleCategory created successfully']);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function VehiclesCategoryById(Request $request){
        try {
            $request->validate(["id" => 'required|string']);

            $rows = VehicleCategory::where('id', $request->input('id'))->first();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function VehiclesCategoryUpdate(Request $request)
    {
        try {
            VehicleCategory::where('id', $request->input('id'))->update([
                'category_name' => $request->input('category_name'),
                'description' => $request->input('description'),
                'maximum_load_capacity' => $request->input('maximum_load_capacity'),
                'seating_capacity' => $request->input('seating_capacity'),
                'status'=>$request->input('status'),
            ]);

            return response()->json(['status' => 'success', 'message' => 'VehicleCategory Update Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function VehiclesCategoryDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $VehiclesCategory = VehicleCategory::find($request->input('id'));

            if (!$VehiclesCategory) {
                return response()->json(['status' => 'fail', 'message' => 'VehiclesCategory not found.']);
            }
            VehicleCategory::where('id', $request->input('id'))->delete();

            return response()->json(['status' => 'success', 'message' => 'VehiclesCategory Delete Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

}
