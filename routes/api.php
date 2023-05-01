<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestPassword;
use App\Http\Controllers\JWTController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\UserController;

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\Sanctum\AuthController;
use App\Http\Controllers\RolePermissionController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['jwt.verify'])->group(function() {
    Route::group(['middleware'=>'api'],function(){



///RolePermission:
Route::get('RolePermission/{id}/show', [RolePermissionController::class,'show']);
Route::get('RolePermission', [RolePermissionController::class,'index']);
Route::delete('RolePermission/{id}/delete', [RolePermissionController::class,'destroy']);
Route::put('RolePermission/{id}/update', [RolePermissionController::class,'update']);
Route::post('RolePermission/create',[RolePermissionController::class,'store']);
///////

///User:
Route::get('User/{id}/show', [UserController::class,'show']);
Route::get('User', [UserController::class,'index']);
Route::delete('User/{id}/delete', [UserController::class,'destroy']);
Route::put('User/{id}/update', [UserController::class,'update']);
Route::post('User/create',[UserController::class,'store']);
///////


Route::post('/sample-restful-apis', [ProfileController::class, 'uploadimage'])->name('sample-restful-apis');

Route::put('/profile/update-profile',[ProfileController::class,'update_profile']);
Route::put('/user/{id}', [ProfileController::class, 'update']);

Route::get('/user', [ProfileController::class, 'show']);

// Route::put('/user/{id}/update', [AuthController::class, 'update']);

Route::post('/imageProfil', [UserController::class, 'uploadimage']);
// Search
// Messages





Route::post('refresh', [JWTController::class,'refresh']);
    Route::post('logout', [JWTController::class,'logout']);

    Route::post('me', [JWTController::class,'me']);
});
});
Route::post('messages', [ChatController::class, 'message']);
///// JWT auth
Route::post('login', [JWTController::class,'login']);
Route::post('register', [JWTController::class,'register']);
Route::post('/forget', [RestPassword::class, 'forgetpassword']);
Route::post('/reset', [RestPassword::class, 'resetPassword']);
/*// Sanctum auth
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('user', [AuthController::class, 'user']);
    Route::post('logout', [AuthController::class, 'logout']);
});*/
