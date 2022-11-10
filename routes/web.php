<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MessageController;
use App\Models\User;
use App\Models\Message;

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

Route::get('/', function () {
    return view('index');
})->middleware('guest')->name('/login_page');
Route::get('/register', function () {
    return view('register');
})->middleware('guest');

Route::get('/chatroom', function () {
    $current_user =new stdClass();
    $current_user->id=0;
    $users=User::where('name','!=',auth()->user()->name)->latest()->get();
    return view('chatroom',[
        'users'=>$users,
        'current_user'=>$current_user

    ]);
})->middleware('auth');

Route::get('/refresh/{user}/{last_message}',[MessageController::class,'ajax']);


Route::post('/login',[UserController::class,'login'])->middleware('guest');

Route::post('/register',[UserController::class,'store'])->middleware('guest');

Route::get('/logout',[UserController::class,'logout'])->middleware('auth');

Route::get('/chatroom/{user}',[UserController::class,'chatroom'])->middleware('auth')->where('user', '[0-9]+');

Route::post('/message/store',[MessageController::class,'store'])->middleware('auth');






