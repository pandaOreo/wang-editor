<?php

use PandaOreo\WangEditor\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('wang-editor', Controllers\WangEditorController::class . '@index');
Route::post('/api/upload/image', Controllers\WangEditorController::class . '@uploadImage');
Route::post('/api/upload/video', Controllers\WangEditorController::class . '@uploadVideo');
