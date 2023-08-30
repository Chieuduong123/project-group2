<?php

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

Route::get('/search', 'Job\JobController@search');
Route::get('/job', 'Job\JobController@getJobPosting');
Route::get('/job/{id}', 'Job\JobController@getDetailJobPosting');
Route::get('/business', 'Business\BusinessController@getBusiness');
Route::get('/business/{id}', 'Business\BusinessController@getDetailBusiness');
Route::get('/job/business/{business}', 'Job\JobController@getJobByBusiness');
Route::post('/password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'Auth\ResetPasswordController@reset');

Route::group(['prefix' => 'business'], function () {
    Route::post('/register', 'Business\AuthBusinessController@register');
    Route::post('/login', 'Business\AuthBusinessController@login');
});

Route::group(['prefix' => 'v1', 'middleware' => ['auth:business']], function () {
    Route::post('/logout', 'Business\AuthBusinessController@logout');
    Route::get('/profile', 'Profile\BusinessProfileController@showProfile');
    Route::post('/profile', 'Profile\BusinessProfileController@updateProfile');
    Route::get('/job', 'Job\JobPostController@getBusinessJobs');
    Route::get('/job/{job}', 'Job\JobPostController@getBusinessJobDetail');
    Route::post('/job', 'Job\JobPostController@store');
    Route::post('/job/{job}', 'Job\JobPostController@update');
    Route::delete('/job/{job}', 'Job\JobPostController@destroy');
    Route::get('/applications', 'Job\ApplicationController@getApplications');
    Route::get('/seeker/{id}', 'Seeker\SeekerController@infoSeeker');
});

Route::group(['prefix' => 'seeker'], function () {
    Route::post('/register', 'Seeker\AuthSeekerController@register');
    Route::post('/login', 'Seeker\AuthSeekerController@login');
});

Route::group(['prefix' => 'seeker', 'middleware' => ['auth:seeker']], function () {
    Route::post('/logout', 'Seeker\AuthSeekerController@logout')->withoutMiddleware(['auth:seeker']);
    Route::get('/refresh', 'Seeker\AuthSeekerController@refresh');
    Route::get('/profile', 'Profile\SeekerProfileController@showProfile');
    Route::post('/profile', 'Profile\SeekerProfileController@updateProfile');
    Route::get('/favorites', 'Favorite\FavoriteController@getFavoriteJobs');
    Route::put('/favorites/{job}', 'Favorite\FavoriteController@addToFavorites');
    Route::delete('/favorites/{job}', 'Favorite\FavoriteController@removeFromFavorites');
    Route::post('/job/{job}/apply', 'Apply\ApplyJobController@applyForJob');
    Route::get('/apply/history', 'Apply\ApplyJobController@getApplicationHistory');
    Route::post('/cv', 'CurriculumVitaes\CVController@store');
});
