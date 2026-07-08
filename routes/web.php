<?php

use Illuminate\Support\Facades\Route;

Route::get('/favicon.ico', function () {
    return response(
        file_get_contents(public_path('favicon.svg')),
        200,
        [
            'Content-Type' => 'image/svg+xml',
            'Cache-Control' => 'public, max-age=604800',
        ]
    );
});

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return redirect()->route('home');
})->middleware('throttle:5,1');

Route::livewire('/home', 'home.index')->name('home');
