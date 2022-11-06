<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UsersModuleController;
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

Route::get('/', [AuthenticationController::class, 'login'])->name('login');
Route::get('login', [AuthenticationController::class, 'login'])->name('login');
Route::post('login', [AuthenticationController::class, 'postLogin'])->name('login');
Route::get('logout', [AuthenticationController::class, 'logout'])->name('logout');

Route::group(['as' => 'backend.', 'middleware' => ['auth']], function () {
    Route::get('users', [UsersModuleController::class, 'users'])->name('users');
    Route::get('users/add', [UsersModuleController::class, 'addUsers'])->name('users.add');
    Route::post('users/add', [UsersModuleController::class, 'postUsers'])->name('users.add');
    Route::get('users/edit/{id}', [UsersModuleController::class, 'editUsers'])->name('users.edit');
    Route::post('users/edit/{id}', [UsersModuleController::class, 'updateUsers'])->name('users.edit');
    Route::get('users/delete/{id}', [UsersModuleController::class, 'deleteUsers'])->name('users.delete');
});