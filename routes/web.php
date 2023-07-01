<?php

use App\Http\Controllers\EmailTesterController;
use App\Http\Controllers\FileUploadsController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\OnlineRegistrationController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\YouthSaversController;
use App\Models\BranchLocationModel;
use App\Models\BranchModel;
use App\Models\TransactionModel;
use App\Models\TransactionStatusModel;
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

Route::get('/', [MainPageController::class, 'index']);

Route::get('/services/youth-application', function () {
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
    'check.status',
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        $stats = TransactionStatusModel::withCount('transactions')->get();
        $totalTransactions = TransactionModel::count();
        return view('dashboard' , compact('stats','totalTransactions'));
    })->name('dashboard');
});

Route::middleware(['auth:sanctum', 'check.status'])->group(function () {

    /**
     * for user management functions admin
     */
    Route::middleware('check.role:admin')->name('user.management.')->prefix('user-management')->group(function () {
        Route::get('/', [UserManagementController::class, 'index'])->name('index');
        Route::post('/add-user', [UserManagementController::class, 'store'])->name('store');
        Route::get('/get-user', [UserManagementController::class, 'edit'])->name('get-user');
        Route::put('/update-user/{id}', [UserManagementController::class, 'update'])->name('update');
        Route::delete('/delete-user/{id}', [UserManagementController::class, 'destroy'])->name('delete');
    });

    /**
     * for transaction functions OLS and new accounts
     */

    Route::middleware('check.role:ols_officer')->name('ols.transaction.')->prefix('transaction')->group(function () {
        Route::get('/', [OnlineRegistrationController::class, 'index'])->name('index');

        Route::middleware('check.level')->group(function () {
            Route::get('/depositor/{id}', [OnlineRegistrationController::class, 'show'])->name('show.depositor');
            Route::get('/print/{id}', [OnlineRegistrationController::class, 'print'])->name('print');
            Route::put('/verify-depositor/{id}', [OnlineRegistrationController::class, 'verify'])->name('verify.depositor');
            Route::put('/disapprove-depositor/{id}', [OnlineRegistrationController::class, 'disapproved_application'])->name('disapprove.application');
            // Route::get('/show-update-application/{id}', [OnlineRegistrationController::class, 'edit'])->name('show.update.application');

            Route::put('/update-application/{id}', [OnlineRegistrationController::class, 'update'])->name('update.application');
        });
        Route::post('/generate-report', [YouthSaversController::class, 'generate'])->name('generate.report');
    });

    Route::middleware('check.role:ho_personnel')->name('ho.personnel.')->prefix('ho')->group(function () {
        Route::get('/denied-transaction', [OnlineRegistrationController::class, 'denied'])->name('denied');
        Route::put('/reset-application/{id}', [OnlineRegistrationController::class, 'reset'])->name('reset.application');
    });
});
