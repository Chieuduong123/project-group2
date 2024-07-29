<?php

use App\Http\Controllers\Web\AuthController;
use App\Http\Controllers\Web\JobController as WebJobController;
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

Route::get('/', function () {
    return view('pages/home');
});

Route::view('forgot_password', 'auth.reset_password')->name('password.reset');
Route::get('/', [WebJobController::class, 'home'])->name('home');
Route::get('/jobs', [WebJobController::class, 'listJobs'])->name('jobs');
Route::get('/jobs/{id}', [WebJobController::class, 'jobDetail'])->name('job-detail');


Route::group(['prefix' => 'v1'], function () {
    Route::get('/register', [AuthController::class, 'registerIndex'])->name('register');
    Route::get('/login', [AuthController::class, 'loginIndex'])->name('login');
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});


Route::group(['middleware' => ['auth:web-seeker']], function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::post('/job/{id}/apply', [WebJobController::class, 'applyJob'])->name('job.apply');
});
