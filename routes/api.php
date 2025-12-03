<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\ProgramDetailController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\EventNewController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\TuitionFeeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/programs', [ProgramController::class, 'index']);
Route::get('/programDetails', [ProgramDetailController::class, 'index']);
Route::get('/banners', [BannerController::class, 'index']);
Route::get('/facilities', [FacilityController::class, 'index']);
Route::get('/tuitionFee', [TuitionFeeController::class, 'index']);
Route::get('/events', [ProgramController::class, 'index']);
Route::get('/eventNews', [EventNewController::class, 'index']);

