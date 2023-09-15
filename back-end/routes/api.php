<?php

use App\Http\Controllers\Apply\ApplyJobController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Business\AuthBusinessController;
use App\Http\Controllers\Business\BusinessController;
use App\Http\Controllers\CurriculumVitaes\CVController;
use App\Http\Controllers\Favorite\FavoriteController;
use App\Http\Controllers\Job\ApplicationController;
use App\Http\Controllers\Job\JobController;
use App\Http\Controllers\Job\JobPostController;
use App\Http\Controllers\Job\RecommendJobController;
use App\Http\Controllers\Profile\BusinessProfileController;
use App\Http\Controllers\Profile\SeekerProfileController;
use App\Http\Controllers\Seeker\AuthSeekerController;
use App\Http\Controllers\Seeker\SeekerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/search', [JobController::class, 'search']);
Route::get('/job', [JobController::class, 'getJobPosting']);
Route::get('/job/highest', [JobController::class, 'jobsWithHighest']);
Route::get('/job/{id}', [JobController::class, 'getDetailJobPosting']);
Route::get('/business', [BusinessController::class, 'getBusiness']);
Route::get('/business/{id}', [BusinessController::class, 'getDetailBusiness']);
Route::get('/job/business/{business}', [JobController::class, 'getJobByBusiness']);
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);


Route::group(['prefix' => 'business'], function () {
    Route::post('/register', [AuthBusinessController::class, 'register']);
    Route::post('/login', [AuthBusinessController::class, 'login']);
});

Route::group(['prefix' => 'v1', 'middleware' => ['auth:business']], function () {
    Route::post('/token/refresh', [AuthBusinessController::class, 'refreshToken']);
    Route::post('/logout', [AuthBusinessController::class, 'logout']);
    Route::get('/profile', [BusinessProfileController::class, 'showProfile']);
    Route::post('/profile', [BusinessProfileController::class, 'updateProfile']);
    Route::get('/job', [JobPostController::class, 'getBusinessJobs']);
    Route::get('/job/{job}', [JobPostController::class, 'getBusinessJobDetail']);
    Route::post('/job', [JobPostController::class, 'store']);
    Route::post('/job/{job}', [JobPostController::class, 'update']);
    Route::delete('/job/{job}', [JobPostController::class, 'destroy']);
    Route::get('/applications', [ApplicationController::class, 'getApplications']);
    Route::get('/application/{id}', [ApplicationController::class, 'getDetailApplications']);
    Route::get('/seeker/{id}', [SeekerController::class, 'infoSeeker']);
});

Route::group(['prefix' => 'seeker'], function () {
    Route::post('/register', [AuthSeekerController::class, 'register']);
    Route::post('/login', [AuthSeekerController::class, 'login']);
});

Route::group(['prefix' => 'seeker', 'middleware' => ['auth:seeker']], function () {
    Route::post('/logout', [AuthSeekerController::class, 'logout'])->withoutMiddleware(['auth:seeker']);
    Route::post('/token/refresh', [AuthSeekerController::class, 'refreshToken']);
    Route::get('/profile', [SeekerProfileController::class, 'showProfile']);
    Route::post('/profile', [SeekerProfileController::class, 'updateProfile']);
    Route::get('/favorites', [FavoriteController::class, 'getFavoriteJobs']);
    Route::put('/favorites/{job}', [FavoriteController::class, 'addToFavorites']);
    Route::delete('/favorites/{job}', [FavoriteController::class, 'removeFromFavorites']);
    Route::post('/job/{job}/apply', [ApplyJobController::class, 'applyForJob']);
    Route::get('/apply/history', [ApplyJobController::class, 'getApplicationHistory']);
    Route::get('/cv', [CVController::class, 'getCV']);
    Route::get('/cv/{cvId}', [CVController::class, 'getDetailCV']);
    Route::post('/cv', [CVController::class, 'store']);
    Route::put('/cv/{cvId}', [CVController::class, 'update']);
    Route::delete('/cv/{cvId}', [CVController::class, 'destroy']);
    Route::get('/recommend', [RecommendJobController::class, 'getRecommend']);
    Route::post('/job/recommend', [RecommendJobController::class, 'store']);
    Route::post('/job/recommend/{recommendId}', [RecommendJobController::class, 'update']);
    Route::get('/recommend/job', [JobController::class, 'recommendJob']);
});
