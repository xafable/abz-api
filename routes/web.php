<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ViewController;
use App\Models\Position;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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





Route::post('/auth', function (Request $request) {

    //return var_export($request->all(), true);
    if(Auth::attempt(['name' => $request->name, 'password' => $request->password])){
        $auth = Auth::user();
        $success['token'] =  $auth->createToken('LaravelSanctumAuth')->plainTextToken;
        $success['name'] =  $auth->name;

        return $success;
    }
    else return 'error';

});




Route::get(
    '/start',
    [ViewController::class, 'show']
)->name('start');




