<?php

use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\registerController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\StaffsController;
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


Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

Route::get('/register', [registerController::class, 'index'])->name('register');
Route::post('/register', [registerController::class, 'save']);

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'save']);


Route::get('/emailverification', [EmailVerificationController::class, 'index'])->name('emailverification');
Route::post('/emailverification', [EmailVerificationController::class, 'index']);

Route::get('/forgotpassword', [ForgotPasswordController::class, 'index'])->name('forgotpassword');
Route::post('/forgotpassword', [ForgotPasswordController::class, 'email']);


Route::get('/forgotpassword/code', [ForgotPasswordController::class, 'code']);
Route::post('/forgotpassword/code', [ForgotPasswordController::class, 'code']);

Route::get('/forgotpassword/password', [ForgotPasswordController::class, 'password']);
Route::post('/forgotpassword/password', [ForgotPasswordController::class, 'password']);

Route::group(['middleware'=>'auth'], function(){

    Route::get('/', [HomeController::class, 'index'])->name('home');

    // schools routes
    Route::get('/schools', [SchoolsController::class, 'index'])->name('school');
    
    Route::get('/schools/add', [SchoolsController::class, 'add']);
    Route::post('/schools/add', [SchoolsController::class, 'add']);
    
    Route::get('/schools/switch/{id}', [SchoolsController::class, 'switch']);
    // Route::post('/schools/switch/{id}', [SchoolsController::class, 'switch']);
    
    Route::get('/schools/edit/{id}', [SchoolsController::class, 'edit']);
    Route::post('/schools/edit/{id}', [SchoolsController::class, 'edit']);
    
    Route::get('/schools/delete/{id}', [SchoolsController::class, 'delete']);
    Route::post('/schools/delete/{id}', [SchoolsController::class, 'delete']);

    // staffs routes
    Route::get('/staffs', [StaffsController::class, 'index']);
    
    Route::get('/staffs/add', [StaffsController::class, 'add']);
    Route::post('/staffs/add', [StaffsController::class, 'add']);
    
    Route::get('/staffs/edit/{id}', [StaffsController::class, 'edit']);
    Route::post('/staffs/edit/{id}', [StaffsController::class, 'edit']);
    
    Route::get('/staffs/delete{id}', [StaffsController::class, 'delete']);
    Route::post('/staffs/delete{id}', [StaffsController::class, 'delete']);

    // students routes
    Route::get('/students', [StudentsController::class, 'index']);
    
    Route::get('/students/add', [StudentsController::class, 'add']);
    Route::post('/students/add', [StudentsController::class, 'add']);
    
    Route::get('/students/edit/{id}', [StudentsController::class, 'edit']);
    Route::post('/students/edit/{id}', [StudentsController::class, 'edit']);
    
    Route::get('/students/delete{id}', [StudentsController::class, 'delete']);
    Route::post('/students/delete{id}', [StudentsController::class, 'delete']);


    Route::get('/profile/{userid}', [ProfileController::class, 'index']);
    Route::post('/profile/{userid}', [ProfileController::class, 'index']);

});



