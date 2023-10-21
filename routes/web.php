<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\UserController;
use App\Models\Agent;
use App\Models\Company;
use App\Models\Passenger;
use App\Models\Visa;

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

$agent = Agent::all();
$passengers = Passenger::all();
$company = Company::all();
$visa = Visa::all();
foreach ($passengers as $passenger) {
    $passenger->agent = Agent::where('id', $passenger->agent)->value('name');
}
Route::view('/agency', 'layout.agency', compact('agent'))->name('agency');
Route::view('/company', 'layout.company', compact('company'))->name('company');
Route::view('/pasesnger', 'layout.passenger', compact('agent','passengers'))->name('passenger');

Route::view('/visa_purchase', 'layout.visa_purchase',compact('company','visa','agent'))->name('visa_purchase');
Route::view('/visa_sell', 'layout.visa_sell',compact('company','visa','agent'))->name('visa_sell');

Route::view('/hajj_purchase', 'layout.hajj_purchase',compact('company','visa','agent'))->name('hajj_purchase');
Route::view('/hajj_sell', 'layout.hajj_sell',compact('company','visa','agent'))->name('hajj_sell');

Route::view('/umrah_purchase', 'layout.umrah_purchase',compact('company','visa','agent'))->name('umrah_purchase');
Route::view('/umrah_sell', 'layout.umrah_sell',compact('company','visa','agent'))->name('umrah_sell');

Route::view('/ticket_purchase', 'layout.ticket_purchase',compact('company','visa','agent'))->name('ticket_purchase');
Route::view('/ticket_sell', 'layout.ticket_sell',compact('company','visa','agent'))->name('ticket_sell');

Route::any('/signup', [ViewController::class, 'signup'])->name('signup');
Route::any('/login', [ViewController::class, 'login'])->name('login');
Route::get('/forget-password', [ViewController::class, 'forgetPassword'])->name('forget-password');
Route::post('/getemail', [Mailcontroller::class,  'getemail'])->name('getemail');
Route::any('send-mail', [Mailcontroller::class, 'index'])->name('send-mail');
Route::get('/check-email', [ViewController::class, 'checkEmail'])->name('checkEmail');
Route::post('/password-reset', [ViewController::class, 'setnewpassword'])->name('password_reset');


#user routes
Route::any('/user/index', [UserController::class, 'index'])->name('user/index');
Route::any('/user/passenger', [UserController::class, 'passenger'])->name('user/passenger');
Route::any('/user/company', [UserController::class, 'company'])->name('user/company');
Route::any('/user/visa', [UserController::class, 'visa'])->name('user/visa');
Route::any('/user/visaadd/{id}', [UserController::class, 'visa_add'])->name('user/visaadd');// Change the Route::any to Route::post to specify that this route handles POST requests
Route::any('/user/personal_edit/{id}', [UserController::class, 'personal_edit'])->name('user/personal_edit');
Route::any('/user/visa_edit/{id}', [UserController::class, 'visa_edit'])->name('user/visa_edit');
Route::any('/user/embassy_list', [UserController::class, 'embassy_list'])->name('user/embassy_list');
Route::any('/user/update', [UserController::class, 'update'])->name('user/update');
Route::any('/user/print/{id}', [UserController::class, 'printer'])->name('user/print');
Route::any('/user/get', [UserController::class, 'get'])->name('getpassport');
Route::get('/check-passport/{passport}', [UserController::class, 'checkPassport']);
Route::get('/view/{id}', [UserController::class, 'view'])->name('view');
Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
Route::get('/delete/{id}', [UserController::class, 'delete'])->name('delete');
Route::any('user/logout', [UserController::class, 'logout'])->name('user/logout');