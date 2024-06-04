<?php

namespace App\Http\Controllers;

use App\Models\vehicleDocumentRegistration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class vehicleDocumentRegistrationController extends Controller
{
    public function VehicleDocumentsCreate(Request $request)
    {
        try {
            $request->validate([
                'vehicle' => 'required|unique:vehicle_document_registrations,vehicle_id',
                'registration_number' => 'required',
                'registration_expiry_date' => 'required',
                'insurance_number' => 'nullable',
                'insurance_expiry_date' => 'nullable',
                'tax_token_number' => 'required',
                'tax_token_expiry_date' => 'required',
                'fitness_certificate_number' => 'required',
                'fitness_certificate_expiry_date' => 'required',
                'permit_number' => 'required',
                'permit_expiry_date' => 'required',
                'road_worthiness_certificate_number' => 'nullable',
                'road_worthiness_certificate_expiry_date' => 'nullable',
                'emission_test_certificate_number' => 'nullable',
                'emission_test_certificate_expiry_date' => 'nullable',
                'note' => 'required|string',
                'status' => 'required',
            ]);
            // Create new Vehicle
            $user_id = Auth::id();
            VehicleDocumentRegistration::create([
                'user_id' => $user_id,
                'vehicle_id' => $request->vehicle,
                'registration_number' => $request->registration_number,
                'registration_expiry_date' => $request->registration_expiry_date,
                'insurance_number' => $request->insurance_number,
                'insurance_expiry_date' => $request->insurance_expiry_date,
                'tax_token_number' => $request->tax_token_number, // Removed the extra space here
                'tax_token_expiry_date' => $request->tax_token_expiry_date, // Corrected the field name
                'fitness_certificate_number' => $request->fitness_certificate_number,
                'fitness_certificate_expiry_date' => $request->fitness_certificate_expiry_date,
                'permit_number' => $request->permit_number,
                'permit_expiry_date' => $request->permit_expiry_date,
                'road_worthiness_certificate_number' => $request->road_worthiness_certificate_number,
                'road_worthiness_certificate_expiry_date' => $request->road_worthiness_certificate_expiry_date,
                'emission_test_certificate_number' => $request->emission_test_certificate_number,
                'emission_test_certificate_expiry_date' => $request->emission_test_certificate_expiry_date,
                'note' => $request->note,
                'status' => $request->status
            ]);

            return response()->json(['status' => 'success', 'message' => 'Vehicle documents created successfully']);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    public function VehicleDocumentsList(){
        try {
            $Vehicles_list = VehicleDocumentRegistration::get();
            return response()->json(['status' => 'success', 'vehicles_data' => $Vehicles_list]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function VehicleDocumentsById(Request $request){
        try {
            $request->validate(["id" => 'required|string']);

            $rows = VehicleDocumentRegistration::where('id', $request->input('id'))->first();

            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    public function VehicleDocumentsUpdate(Request $request)
    {
        try {
            VehicleDocumentRegistration::where('id', $request->input('id'))->update([
                'registration_number' => $request->registration_number,
                'registration_expiry_date' => $request->registration_expiry_date,
                'insurance_number' => $request->insurance_number,
                'insurance_expiry_date' => $request->insurance_expiry_date,
                'tax_token_number' => $request->tax_token_number, // Removed the extra space here
                'tax_token_expiry_date' => $request->tax_token_expiry_date, // Corrected the field name
                'fitness_certificate_number' => $request->fitness_certificate_number,
                'fitness_certificate_expiry_date' => $request->fitness_certificate_expiry_date,
                'permit_number' => $request->permit_number,
                'permit_expiry_date' => $request->permit_expiry_date,
                'road_worthiness_certificate_number' => $request->road_worthiness_certificate_number,
                'road_worthiness_certificate_expiry_date' => $request->road_worthiness_certificate_expiry_date,
                'emission_test_certificate_number' => $request->emission_test_certificate_number,
                'emission_test_certificate_expiry_date' => $request->emission_test_certificate_expiry_date,
                'note' => $request->note,
                'status' => $request->status
            ]);

            return response()->json(['status' => 'success', 'message' => 'Vehicle documents updated successfully']);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function VehicleDocumentsDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $VehiclesCategory = VehicleDocumentRegistration::find($request->input('id'));

            if (!$VehiclesCategory) {
                return response()->json(['status' => 'fail', 'message' => 'Vehicle documents not found.']);
            }
            VehicleDocumentRegistration::where('id', $request->input('id'))->delete();
            return response()->json(['status' => 'success', 'message' => 'Vehicle documents Delete Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
}
