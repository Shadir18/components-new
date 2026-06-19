<?php

use App\Http\Controllers\JobController;
use App\Models\Job;
use Illuminate\Support\Facades\Route;

Route::get('/jobs.index', function () {
    $job = Job::first();

    if (! $job) {
        abort(404, 'No jobs available.');
    }

    return redirect()->route('jobs.index', $job);
});

Route::resource('jobs', JobController::class);

Route::get('/about', function(){
    return view('about');
});

Route::get('/contact', function() {
    return view('contact');
});