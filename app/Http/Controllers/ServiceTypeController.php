<?php

namespace App\Http\Controllers;
use Exception;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function ServiceTypeList()
//    {
//        try {
//            $ServiceType_list = ServiceType::with(['serviceProvider',])->get();
//            return response()->json(['status' => 'success', 'servicetype_data' => $ServiceType_list]);
//        } catch (Exception $e) {
//            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
//        }
//    }


    public function ServiceTypeList()
    {
        try {
            $ServiceType_list = ServiceType::with(['serviceProvider'])->get();
            return response()->json(['status' => 'success', 'servicetype_data' => $ServiceType_list]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }




    /**
     * Show the form for creating a new resource.
     */
    public function ServiceTypeCreate(Request $request)
    {
        try {
//            $request->validate([
//
//                'service_name' => 'required|string|max:255',
//                'service_provider_id' => 'required|integer|exists:serviceProvider,id',
//                'service_interval' => 'nullable',
//                'service_description' => 'nullable|string',
//                'user_id' => 'required|integer|exists:users,id',
//            ]);

            // Create new Vehicles Catagory
            $user_id = Auth::id();
            ServiceType::create([

                'service_name' => $request->input('service_name'),
                'service_interval' => $request->input('service_interval'),
                'service_provider_id' => $request->input('service_provider_id'),
                'service_description'=>$request->input('service_description'),
                'user_id' => $user_id
            ]);

            return response()->json(['status' => 'success', 'message' => 'Service type created successfully']);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    /**
     * Store a newly created resource in storage.
     */
    function ServiceTypeById(Request $request){
        try {
            $request->validate(["id" => 'required|string']);

            $rows = ServiceType::where('id', $request->input('id'))->first();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    function ServiceTypeUpdate(Request $request)
    {
        try {
            $ServiceTypeUpdate = ServiceType::find($request->input('id'));
            $ServiceTypeUpdate->service_name = $request->input('service_name');
            $ServiceTypeUpdate->service_interval = $request->input('service_interval');
            $ServiceTypeUpdate->service_provider_id = $request->input('service_provider_id');
            $ServiceTypeUpdate->service_description = $request->input('service_description');

            $ServiceTypeUpdate->save();

            return response()->json(['status' => 'success', 'message' => 'ServiceType Update Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    function ServiceTypeDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $ServiceType = ServiceType::find($request->input('id'));

            if (!$ServiceType) {
                return response()->json(['status' => 'fail', 'message' => 'ServiceType not found.']);
            }
            ServiceType::where('id', $request->input('id'))->delete();

            return response()->json(['status' => 'success', 'message' => 'ServiceType Delete Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */

}
