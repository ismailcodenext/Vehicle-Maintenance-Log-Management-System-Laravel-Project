<?php

namespace App\Http\Controllers;

use App\Models\Test;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
   public function TestList(){
       try {
           $Test_data = Test::get();
           return response()->json(['status' => 'success', 'Test_data' => $Test_data]);
       } catch (Exception $e) {
           return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
       }
   }

    public function TestCreate(Request $request)
    {
        try {
            // Get authenticated user's ID
            $user_id = Auth::id();

            // Create new test
            Test::create([
                'name' => $request->input('name'),
                'user_id' => $user_id
            ]);

            return response()->json(['status' => 'success', 'message' => 'Test created successfully']);
        } catch (Exception $e) {
            // Handle exceptions
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }
    function TestById(Request $request){
        try {
            $user_id = Auth::id();
            $request->validate(["id" => 'required|string']);

            $rows = Test::where('id', $request->input('id'))->where('user_id', $user_id)->first();
            return response()->json(['status' => 'success', 'rows' => $rows]);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }

    function TestUpdate(Request $request)
    {
        try {
            $user_id = Auth::id();
            $Test_Update = Test::find($request->input('id'));
            $Test_Update->name = $request->input('name');

            $Test_Update->save();

            return response()->json(['status' => 'success', 'message' => 'Test Update Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }



    function TestDelete(Request $request)
    {
        try {
            $request->validate([
                'id' => 'required|string|min:1'
            ]);
            $Test_Delete_id = $request->input('id');
            $TestDelete = Test::find($Test_Delete_id);

            if (!$TestDelete) {
                return response()->json(['status' => 'fail', 'message' => 'Test not found.']);
            }
            Test::where('id', $Test_Delete_id)->delete();

            return response()->json(['status' => 'success', 'message' => 'Test Delete Successful']);
        } catch (Exception $e) {
            return response()->json(['status' => 'fail', 'message' => $e->getMessage()]);
        }
    }


}
