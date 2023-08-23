<?php

use App\Http\Controllers\EntryController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EntryController::class, 'create']);

Route::post('/survey-store', [EntryController::class, 'store'])->name('survey.store');
