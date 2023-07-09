<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\StudentsController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);

Route::get('/register', [registerController::class, 'index']);
Route::post('/register', [registerController::class, 'save']);

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'save']);

Route::get('/logout', [LogoutController::class, 'index']);


Route::get('/emailverification', [EmailVerificationController::class, 'index']);
Route::post('/emailverification', [EmailVerificationController::class, 'index']);


Route::get('/forgotpassword', [ForgotPasswordController::class, 'index']);
Route::post('/forgotpassword', [ForgotPasswordController::class, 'save']);

Route::get('/forgotpassword/code', [ForgotPasswordController::class, 'code']);
Route::post('/forgotpassword/code', [ForgotPasswordController::class, 'code']);

Route::get('/forgotpassword/password', [ForgotPasswordController::class, 'password']);
Route::post('/forgotpassword/password', [ForgotPasswordController::class, 'password']);

// schools routes
Route::get('/schools', [SchoolsController::class, 'index']);

Route::get('/schools/add', [SchoolsController::class, 'add']);
Route::post('/schools/add', [SchoolsController::class, 'add']);

Route::get('/schools/switch/{id}', [SchoolsController::class, 'switch']);
// Route::post('/schools/switch/{id}', [SchoolsController::class, 'switch']);

Route::get('/schools/edit/{id}', [SchoolsController::class, 'edit']);
Route::post('/schools/edit/{id}', [SchoolsController::class, 'edit']);

Route::get('/schools/delete/{id}', [SchoolsController::class, 'delete']);
Route::post('/schools/delete/{id}', [SchoolsController::class, 'delete']);


// staffs routes
Route::get('/staffs', [UsersController::class, 'index']);

Route::get('/staffs/add', [UsersController::class, 'add']);
Route::post('/staffs/add', [UsersController::class, 'add']);

Route::get('/staffs/edit/{id}', [UsersController::class, 'edit']);
Route::post('/staffs/edit/{id}', [UsersController::class, 'edit']);

Route::get('/staffs/delete{id}', [UsersController::class, 'delete']);
Route::post('/staffs/delete{id}', [UsersController::class, 'delete']);


// students routes
Route::get('/students', [StudentsController::class, 'index']);

Route::get('/students/add', [StudentsController::class, 'add']);
Route::post('/students/add', [StudentsController::class, 'addschool']);

Route::get('/students/edit/{id}', [StudentsController::class, 'edit']);
Route::post('/students/edit/{id}', [StudentsController::class, 'edit']);

Route::get('/students/delete{id}', [StudentsController::class, 'delete']);
Route::post('/students/delete{id}', [StudentsController::class, 'delete']);

