<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\StatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\MatcheController;
use App\Http\Controllers\PreselectionController;
use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\MessageController;
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

Route::get('/', [HomeController::class, 'index'])->middleware('auth');

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::resource('stats', StatController::class)->middleware('auth');
Route::resource('users', UserController::class)->middleware('auth')->middleware('users');
Route::post('users/search', [UserController::class, 'search'])->name('users.search');
Route::post('applicants/search', [ApplicantController::class, 'search'])->name('applicants.search');
Route::get('applicants/change', [ApplicantController::class,'change'])->name('applicants.change');
Route::resource('applicants', ApplicantController::class)->middleware('auth')->middleware('applicants');
Route::post('customers/search', [CustomerController::class, 'search'])->name('customers.search');
Route::resource('customers', CustomerController::class)->middleware('auth')->middleware('customers');
Route::post('positions/search', [PositionController::class, 'search'])->name('positions.search');
Route::get('positions/change', [PositionController::class,'change'])->name('positions.change');
Route::resource('positions', PositionController::class)->middleware('auth')->middleware('positions');
Route::resource('matches',  MatcheController::class)->middleware('auth')->middleware('matches');
Route::post('preselections/search', [PreselectionController::class, 'search'])->name('preselections.search');
Route::get('preselections/change', [PreselectionController::class,'change'])->name('preselections.change');
Route::resource('preselections',  PreselectionController::class)->middleware('auth')->middleware('preselections');
Route::resource('evaluations',  EvaluationController::class)->middleware('auth');
Route::resource('messages', MessageController::class)->middleware('auth');


Route::get('/linkstorage', function(){Artisan::call('storage:link'); });