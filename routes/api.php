<?php

use App\Http\Controllers\Auth\loginController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\HeaderController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\SocialController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(['guest'])->post('/auth/login', [loginController::class, 'login']);

//Route::middleware(['guest'])->post('/login', [loginController::class, 'store']);

Route::get('/info',[ProfileController::class,'index']);
Route::apiResource('/skills',SkillController::class);
Route::apiResource('/socials',SocialController::class);
Route::post('/linkSkillsToCourse/{course}',[SkillController::class,'linkSkillsToCourse'])->name('linkSkillsToCourse');
Route::post('/linkSkillsToExperience/{experience}',[SkillController::class,'linkSkillsToExperience'])->name('linkSkillsToExperience');
Route::group(['prefix' => 'en'], function () {
    Route::apiResource('courses', CourseController::class);
});
Route::group(['prefix' => 'ar'], function () {
    Route::apiResource('courses', CourseController::class);
});
Route::group(['prefix' => 'en'], function () {
    Route::apiResource('experiences', ExperienceController::class);
});
Route::group(['prefix' => 'ar'], function () {
    Route::apiResource('experiences', ExperienceController::class);
});

Route::group(['prefix' => 'en'], function () {
    Route::apiResource('header', HeaderController::class);
});
Route::group(['prefix' => 'ar'], function () {
    Route::apiResource('header', HeaderController::class);
});
Route::apiResource('/message',MessageController::class);
