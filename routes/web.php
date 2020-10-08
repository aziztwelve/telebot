<?php

use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\SettingController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth'])->prefix('admin')->namespace('Backend')->name('admin.')->group(function (){
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
    Route::post('/setting/store', [SettingController::class, 'store'])->name('setting.store');

    Route::post('/setting/setwebhook', [SettingController::class, 'setwebhook'])->name('setting.setwebhook');
    Route::post('/setting/getwebhookinfo', [SettingController::class, 'getwebhookinfo'])->name('setting.getwebhookinfo');


});

Route::match(['post', 'get'], 'register', function (){
   \Illuminate\Support\Facades\Auth::logout();
   return redirect('/');
})->name('register');

Route::get('/home', 'HomeController@index')->name('home');
