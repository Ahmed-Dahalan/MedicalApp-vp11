<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Middleware\AgeCheackMiddelware;
use GuzzleHttp\Middleware;
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

Route::prefix('cms')->middleware('guest:patient,admin')->group(function () {
    Route::get('/{guard}/login', [AuthController::class, 'showLoginVeiw'])->name('auth.login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/patient/register', [AuthController::class, 'showRegisterVeiw'])->name('auth.register');
    Route::post('/register', [AuthController::class, 'Register']);
});
Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('admins', AdminController::class);
});
Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {
    Route::post('roles/permissions', [RoleController::class, 'UpdateRolePermission']);
    Route::get('patients/{patient}/permissions/edit', [PatientController::class, 'editPatientPermission'])->name('patient.edit_permissions');
    Route::put('patients/{patient}/permissions/edit', [PatientController::class, 'updatePatientPermission'])->name('patient.update_permissions');
});
Route::prefix('cms/admin')->middleware('auth:patient,admin')->group(function () {
    Route::view('/', 'cms.dashbord');
    Route::resource('cities', CityController::class);
    Route::resource('patients', PatientController::class);
    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');
});

// Route::get('/News', function () {
//     echo ('News content appers here!');
// })->middleware('ageCheack:22');
// Route::get('/News', function () {
//     echo ('News content appers here!');
// })->middleware(AgeCheackMiddelware::class);//بنفع هيك بدون ما تروح تحط في kernal
// Route::middleware('ageCheack')->group(function () {
//     Route::get('/news/1', function () {
//         echo ('News 1 content appers here!');
//     })->withoutMiddleware('ageCheack');
//     Route::get('/news/2', function () {
//         echo ('News 2 content appers here!');
//     });
// });
