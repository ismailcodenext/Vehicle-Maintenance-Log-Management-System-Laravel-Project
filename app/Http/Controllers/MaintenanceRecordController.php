<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;

use App\Models\MaintenanceRecord;
use Illuminate\Support\Facades\Auth;

class MaintenanceRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function MaintenanceList()
    {
        try {
            $maintenanceRecords = MaintenanceRecord::with(['serviceType', 'vehicle', 'serviceProvider'])->get();
            return response()->json(['status' => 'success', 'MaintenanceRecord_data' => $maintenanceRecords]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    /**
     * Show the form for creating a new resource.
     */
//    public function MaintenanceCreate(Request $request)
//    {
//        try {
////             $request->validate([
////                'vehicle_id' => 'required|exists:vehicles,id',
////                'date_of_service' => 'required|date',
////                'mileage_at_service' => 'required|integer',
////                'service_type_id' => 'required|exists:service_types,id',
////                'description_of_service' => 'nullable|string',
////                'cost' => 'nullable|numeric',
////                'image_upload' => 'nullable|image',
////
////            ]);
//            $img = $request->file('img');
//            $t = time();
//            $file_name = $img->getClientOriginalName();
//            $img_name = "{$t}-{$file_name}";
//            $img_url = "uploads/maintenance-img/{$img_name}";
//            $img->move(public_path('uploads/maintenance-img'), $img_name);
//
//            $user_id = Auth::id();
//            MaintenanceRecord::create([
//                'vehicle_id' => $request->input('vehicle_id'),
//                'date_of_service' => $request->input('date_of_service'),
//                'mileage_at_service' => $request->input('mileage_at_service'),
//                'service_type_id' => $request->input('service_type_id'),
//                'service_provider_id' => $request->input('service_provider_id'),
//                'description_of_service'=>$request->input('description_of_service'),
//                'cost'=>$request->input('cost'),
//                'image_upload'=>$img_url,
//                'user_id' => $user_id
//            ]);
//
//
//            return response()->json(['status' => 'success', 'message' => 'Maintenance created successfully']);
//        } catch (Exception $e) {
//            // Handle exceptions
//            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
//        }
//    }



    public function MaintenanceCreate(Request $request)
    {
        $request->validate([
            'vehicle_id' => 'required|exists:vehicles,id',
            'date_of_service' => 'required|date',
            'mileage_at_service' => 'required|integer',
            'service_type_id' => 'required|exists:service_types,id',
            'service_provider_id' => 'required|exists:service_providers,id',
            'description_of_service' => 'nullable|string',
            'cost' => 'nullable|numeric',
            'img' => 'nullable|image',
        ]);

        try {
            $img = $request->file('img');
            $img_url = null;
            if ($img) {
                $t = time();
                $file_name = $img->getClientOriginalName();
                $img_name = "{$t}-{$file_name}";
                $img_url = "uploads/maintenance-img/{$img_name}";
                $img->move(public_path('uploads/maintenance-img'), $img_name);
            }

            $user_id = Auth::id();
            MaintenanceRecord::create([
                'vehicle_id' => $request->input('vehicle_id'),
                'date_of_service' => $request->input('date_of_service'),
                'mileage_at_service' => $request->input('mileage_at_service'),
                'service_type_id' => $request->input('service_type_id'),
                'service_provider_id' => $request->input('service_provider_id'),
                'description_of_service' => $request->input('description_of_service'),
                'cost' => $request->input('cost'),
                'image_upload' => $img_url,
                'user_id' => $user_id
            ]);

            return response()->json(['status' => 'success', 'message' => 'Maintenance created successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }



    /**
     * Store a newly created resource in storage.
     */
    function MaintenanceById(Request $request){
        try {
            $request->validate(["id" => 'required|string']);

            $rows = MaintenanceRecord::where('id', $request->input('id'))->first();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function MaintenanceUpdate(Request $request)
    {
        try {
            $img = $request->file('img');
            $t = time();
            $file_name = $img->getClientOriginalName();
            $img_name = "{$t}-{$file_name}";
            $img_url = "uploads/user-img/{$img_name}";
            $img->move(public_path('uploads/user-img'), $img_name);

            MaintenanceRecord::where('id', $request->input('id'))->update([
                'vehicle_id' => $request->input('vehicle_id'),
                'date_of_service' => $request->input('date_of_service'),
                'mileage_at_service' => $request->input('mileage_at_service'),
                'service_type_id' => $request->input('service_type_id'),
                'description_of_service'=>$request->input('description_of_service'),
                'cost'=>$request->input('cost'),
                'image_upload'=>$img_url,

            ]);

            return response()->json(['status' => 'success', 'message' => 'MaintenanceRecord Update Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


    /**
     * Display the specified resource.
     */
    function MaintenanceDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $ServiceType = MaintenanceRecord::find($request->input('id'));

            if (!$ServiceType) {
                return response()->json(['status' => 'fail', 'message' => 'MaintenanceRecord not found.']);
            }
            MaintenanceRecord::where('id', $request->input('id'))->delete();

            return response()->json(['status' => 'success', 'message' => 'MaintenanceRecord Delete Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
