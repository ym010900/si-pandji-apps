<?php

use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('home'));
Route::get('/mood', fn() => view('mood'));
Route::get('/chat', fn() => view('chat'));
Route::get('/sentiment', fn() => view('sentiment'));
