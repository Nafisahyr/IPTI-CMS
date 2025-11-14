<?php
use App\Http\Controllers\ProgramController;
use Illuminate\Support\Facades\Route;

Route::get('/programs', [ProgramController::class, 'index']);
