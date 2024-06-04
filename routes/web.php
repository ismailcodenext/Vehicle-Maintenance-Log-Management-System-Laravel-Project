<?php


use App\Http\Controllers\DriverController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\VehicleAssignedToDriveController;
use Illuminate\Support\Facades\Route;



// ------------Controller Work By  start--------------------
use App\Http\Controllers\UserController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\VehiclesCategoryController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\vehicleDocumentRegistrationController;

// ------------Controller Work By  End--------------------


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// Open Dashboard API Route
Route::view('/', 'pages.front-end-page.auth.login-page');

// ALL View API Route Start

Route::view('/vlmms-login-page', 'pages.front-end-page.auth.login-page')->name('login');
Route::view('/registration', 'pages.front-end-page.auth.registration-page');
Route::view('/sendOtp', 'pages.front-end-page.auth.send-otp-page');
Route::view('/verifyOtp', 'pages.front-end-page.auth.verify-otp-page');
Route::view('/resetPassword', 'pages.front-end-page.auth.reset-pass-page');
Route::view('/userProfile', 'pages.dashboard.profile-page');
Route::view('/testPage', 'pages.back-end-page.test.test-page');
Route::view('/vehiclesCategoryPage', 'pages.back-end-page.vehicles_categories.vehicles_categories_page');
Route::view('/driverPage', 'pages.back-end-page.driver.driver-page');
Route::view('/vehiclesPage', 'pages.back-end-page.vehicles.vehicles_page');
Route::view('/vehiclesDocumentsPage', 'pages.back-end-page.vehicles_documents.vehicles_documents_registrations_page');
Route::view('/permissions', 'pages.back-end-page.role-permission.permission.permission-page');
Route::view('/roles', 'pages.back-end-page.role-permission.role.role-page');
Route::view('/vehicleAssignedToDriverPage', 'pages.back-end-page.vehicle-assigned-to-driver.vehicle-assigned-to-driver-page');

// User Web API Routes
// Route::post('/user-registration', [UserController::class, 'UserRegistration'])->middleware('auth:sanctum');
Route::post('/user-registration', [UserController::class, 'UserRegistration']);
Route::post('/user-login', [UserController::class, 'UserLogin']);
Route::get('/user-profile', [UserController::class, 'UserProfile'])->middleware('auth:sanctum');
Route::get('/vlmms-logout-page', [UserController::class, 'UserLogout'])->middleware('auth:sanctum');
Route::post('/user-update', [UserController::class, 'UpdateProfile'])->middleware('auth:sanctum');
Route::post('/send-otp', [UserController::class, 'SendOTPCode']);
Route::post('/verify-otp', [UserController::class, 'VerifyOTP']);
Route::post('/reset-password', [UserController::class, 'ResetPassword'])->middleware('auth:sanctum');

// front-page API Route End

// Dashboard API Route start
// Route::view('/dashboardSummary','pages.back-end-page.dashboard-page');
Route::view('/dashboard', 'pages.dashboard.dashboard-page')->middleware('auth:sanctum');

//  Page View API Route

// Dashboard API Route End

//Driver all route start
Route::get("/list-driver", [DriverController::class, 'DriverList'])->middleware('auth:sanctum');
Route::post("/create-driver", [DriverController::class, 'DriverCreate'])->middleware('auth:sanctum');
Route::post("/driver-by-id", [DriverController::class, 'DriverById'])->middleware('auth:sanctum');
Route::post("/update-driver", [DriverController::class, 'DriverUpdate'])->middleware('auth:sanctum');
Route::post("/delete-driver", [DriverController::class, 'DriverDelete'])->middleware('auth:sanctum');
//Driver all route end end

//Test all route start
Route::get("/list-test", [TestController::class, 'TestList'])->middleware('auth:sanctum');
Route::post("/create-test", [TestController::class, 'TestCreate'])->middleware('auth:sanctum');
Route::post("/test-by-id", [TestController::class, 'TestById'])->middleware('auth:sanctum');
Route::post("/update-test", [TestController::class, 'TestUpdate'])->middleware('auth:sanctum');
Route::post("/delete-test", [TestController::class, 'TestDelete'])->middleware('auth:sanctum');
//Test all route start end



//Vehicles Category all route start
Route::get("/list-vehicles-category", [VehiclesCategoryController::class, 'VehiclesCategoryList'])->middleware('auth:sanctum');
Route::post("/create-vehicles-category", [VehiclesCategoryController::class, 'VehiclesCategoryCreate'])->middleware('auth:sanctum');
Route::post("/vehicles-category-by-id", [VehiclesCategoryController::class, 'VehiclesCategoryById'])->middleware('auth:sanctum');
Route::post("/update-vehicles-category", [VehiclesCategoryController::class, 'VehiclesCategoryUpdate'])->middleware('auth:sanctum');
Route::post("/delete-vehicles-category", [VehiclesCategoryController::class, 'VehiclesCategoryDelete'])->middleware('auth:sanctum');
//Vehicles Category all route start end

//Vehicles all route start
Route::get("/list-vehicles", [VehicleController::class, 'VehiclesList'])->middleware('auth:sanctum');
Route::post("/create-vehicles", [VehicleController::class, 'VehicleCreate'])->middleware('auth:sanctum');
Route::post("/vehicles-by-id", [VehicleController::class, 'VehicleById'])->middleware('auth:sanctum');
Route::post("/update-vehicles", [VehicleController::class, 'VehiclesUpdate'])->middleware('auth:sanctum');
Route::post("/delete-vehicles", [VehicleController::class, 'VehiclesDelete'])->middleware('auth:sanctum');
Route::get("/active-list-vehicles", [VehicleController::class, 'ActiveVehiclesList'])->middleware('auth:sanctum');
//Vehicles all route end

// Vehicles documents registrations all route start
Route::post("/create-vehicles-documents", [VehicleDocumentRegistrationController::class, 'VehicleDocumentsCreate'])->middleware('auth:sanctum');
Route::get("/list-vehicles-documents", [VehicleDocumentRegistrationController::class, 'VehicleDocumentsList'])->middleware('auth:sanctum');
Route::post("/vehicles-documents-by-id", [VehicleDocumentRegistrationController::class, 'VehicleDocumentsById'])->middleware('auth:sanctum');
Route::Post("/update-vehicles-documents", [VehicleDocumentRegistrationController::class, 'VehicleDocumentsUpdate'])->middleware('auth:sanctum');
Route::post("/delete-vehicles-documents", [VehicleDocumentRegistrationController::class, 'VehicleDocumentsDelete'])->middleware('auth:sanctum');


//Permission route all route
Route::get("/list-permission", [PermissionController::class, 'permissionList'])->middleware('auth:sanctum');
Route::post("/create-permission", [PermissionController::class, 'permissionCreate'])->middleware('auth:sanctum');
Route::post("/permission-by-id", [PermissionController::class, 'permissionById'])->middleware('auth:sanctum');
Route::post("/update-permission", [PermissionController::class, 'permissionUpdate'])->middleware('auth:sanctum');
Route::post("/delete-permission", [PermissionController::class, 'permissionDelete'])->middleware('auth:sanctum');

//Permission route all route
Route::get("/list-role", [RoleController::class, 'roleList'])->middleware('auth:sanctum');
Route::post("/create-role", [RoleController::class, 'roleCreate'])->middleware('auth:sanctum');
Route::post("/role-by-id", [RoleController::class, 'roleById'])->middleware('auth:sanctum');
Route::post("/update-role", [RoleController::class, 'roleUpdate'])->middleware('auth:sanctum');
Route::post("/delete-role", [RoleController::class, 'roleDelete'])->middleware('auth:sanctum');

Route::get("/list-vehicle-assigned-to-driver", [VehicleAssignedToDriveController::class, 'vehicleAssignedToDriverList'])->middleware('auth:sanctum');
Route::post("/create-vehicle-assigned-to-driver", [VehicleAssignedToDriveController::class, 'vehicleAssignedToDriverCreate'])->middleware('auth:sanctum');
Route::post("/vehicle-assigned-to-driver-by-id", [VehicleAssignedToDriveController::class, 'vehicleAssignedToDriverById'])->middleware('auth:sanctum');
Route::post("/update-vehicle-assigned-to-driver", [VehicleAssignedToDriveController::class, 'vehicleAssignedToDriverUpdate'])->middleware('auth:sanctum');
Route::post("/delete-vehicle-assigned-to-driver", [VehicleAssignedToDriveController::class, 'vehicleAssignedToDriverDelete'])->middleware('auth:sanctum');
