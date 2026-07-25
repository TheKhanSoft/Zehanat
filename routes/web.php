<?php

use Illuminate\Support\Facades\Route;

// Public website routes
Route::view('/', 'public.home')->name('home');
Route::view('/about', 'public.about')->name('about');
Route::view('/pillars', 'public.pillars')->name('pillars');
Route::view('/programs', 'public.programs')->name('programs');
Route::view('/membership', 'public.membership')->name('membership');
Route::view('/news-events', 'public.news-events')->name('news-events');
Route::view('/resources', 'public.resources')->name('resources');
Route::view('/faq', 'public.faq')->name('faq');
Route::view('/contact', 'public.contact')->name('contact');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

require __DIR__.'/settings.php';
