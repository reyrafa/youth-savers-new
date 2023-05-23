<?php

use App\Http\Controllers\EmailTesterController;
use App\Http\Controllers\FileUploadsController;
use App\Http\Controllers\OnlineRegistrationController;
use App\Http\Controllers\UserManagementController;
use App\Models\BranchLocationModel;
use App\Models\BranchModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


/*==================================== online application process ================================*/

Route::get('/', function () {
    $locations = BranchLocationModel::all();
    $branchs = BranchModel::all();
    return view('welcome', compact('locations', 'branchs'));
});

/*============================ file uploads (signature, ID, birth certificate) =========================*/
Route::post('/upload-signature', [FileUploadsController::class, 'store_signature']);
Route::delete('/upload-signature-revert', [FileUploadsController::class, 'delete_signature']);
Route::post('/upload-identification', [FileUploadsController::class, 'store_identification']);
Route::delete('/upload-identification-revert', [FileUploadsController::class, 'delete_identification']);
Route::post('/upload-bcertificate', [FileUploadsController::class, 'store_bcertificate']);
Route::delete('/upload-bcertificate-revert', [FileUploadsController::class, 'delete_bcertificate']);
Route::post('/upload-receipt', [FileUploadsController::class, 'store_receipt']);
Route::delete('/upload-receipt-revert', [FileUploadsController::class, 'delete_receipt']);

Route::post('/depositor-online-registration', [OnlineRegistrationController::class, 'store'])->name('depositor.store');
Route::get('/get-branch', function (Request $req) {
    $response = BranchModel::where('branch_loc_id', $req->id)->take(100)->get();
    return response()->json($response);
});

Route::get('/email-testing', [EmailTesterController::class, 'for_testing_email']);


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware('auth:sanctum')->group(function () {
    /**
     * for user management functions
     */
    Route::prefix('user-management')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('user.management.index');
    });
});
