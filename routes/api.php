<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CourseController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\HomeworkController;
use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\MenuItemController;
use App\Http\Controllers\Api\ModuleController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\UserRoleController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::any('/', [AuthController::class, 'any']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::post('login', [AuthController::class, 'login_post'])->name('api.login');
Route::post('register', [AuthController::class, 'registerUser'])->name('api.register');
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('api.forgot-password');
Route::post('reset-password/{token}', [AuthController::class, 'resetPassword'])->name('api.reset-password');
Route::post('logout', [AuthController::class, 'logout'])->name('api.logout');


Route::get('courses', [CourseController::class, 'index']);
Route::get('courses/{course}', [CourseController::class, 'show']);
Route::get('courses/{course}/lectures', [CourseController::class, 'getLectures']);
Route::post('courses', [CourseController::class, 'store']);
Route::post('courses/{course}/update', [CourseController::class, 'updateCourse']);   // ????
Route::delete('courses/{course}', [CourseController::class, 'destroy']);


Route::get('/homework', [HomeworkController::class, 'index']);
Route::get('/homework/create', [HomeworkController::class, 'create']);
Route::post('/homework/store', [HomeworkController::class, 'store']);
Route::get('/homework/{homework}', [HomeworkController::class, 'show']);
Route::get('/homework/{homework}/edit', [HomeworkController::class, 'edit']);
Route::post('/homework/{homework}/update', [HomeworkController::class, 'update']);
Route::delete('/homework/{homework}', [HomeworkController::class, 'destroy']);


Route::get('/lectures', [LectureController::class, 'index']);
Route::get('/lectures/create', [LectureController::class, 'create']);
Route::post('/lectures/store', [LectureController::class, 'store']);
Route::get('/lectures/{lecture}', [LectureController::class, 'show']);
Route::get('/lectures/{lecture}/edit', [LectureController::class, 'edit']);
Route::post('/lectures/{lecture}/update', [LectureController::class, 'update']);
Route::delete('/lectures/{lecture}', [LectureController::class, 'destroy']);


Route::get('/menuItems', [MenuItemController::class, 'index']);
Route::get('/menuItems/create', [MenuItemController::class, 'create']);
Route::post('/menuItems', [MenuItemController::class, 'store']);
Route::get('/menuItems/{menuItem}', [MenuItemController::class, 'show']);
Route::get('/menuItems/{menuItem}/edit', [MenuItemController::class, 'edit']);
Route::post('/menuItems/{menuItem}', [MenuItemController::class, 'update']);
Route::delete('/menuItems/{menuItem}', [MenuItemController::class, 'destroy']);

Route::get('/modules', [ModuleController::class, 'index']);
Route::get('/modules/create', [ModuleController::class, 'create']);
Route::post('/modules/store', [ModuleController::class, 'store']);
Route::get('/modules/{module}', [ModuleController::class, 'show']);
Route::get('/modules/{module}/edit', [ModuleController::class, 'edit']);
Route::put('/modules/{module}/update', [ModuleController::class, 'update']);
Route::delete('/modules/{module}/destroy', [ModuleController::class, 'destroy']);

Route::get('/students', [StudentController::class, 'index']);
Route::get('/students/{user}', [StudentController::class, 'show']);


Route::get('/users', [UserController::class, 'index']);
Route::get('/users/create', [UserController::class, 'create']);
Route::post('/users', [UserController::class, 'store']);
Route::get('/users/{user}', [UserController::class, 'show']);
Route::get('/users/{user}/edit', [UserController::class, 'edit']);
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}/destroy', [UserController::class, 'destroy']);
