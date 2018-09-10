<?php

Route::get('/home', function () {
    $users[] = Auth::user();
    $users[] = Auth::guard()->user();
    $users[] = Auth::guard('dashboard')->user();

    //dd($users);

    return view('dashboard.home');
})->name('home');

