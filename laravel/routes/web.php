<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SecurityController;

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

Route::get('/', function (Request $request) {
    $message = 'Loading welcome page';
    Log::info($message);
    $request->session()->flash('info', $message);
    return view('welcome');
 });
 
Route::get('mail/test', [MailController::class, 'test'])
    ->middleware('auth');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('files', FileController::class)->middleware(['auth', 'roles:3']);
Route::resource('security/users', UsersController::class)->middleware(['auth', 'roles:1,4']);
Route::resource('security/roles', RoleController::class)->middleware(['auth', 'roles:1,4']);
Route::resource('security', SecurityController::class)->middleware(['auth', 'roles:1,4']);