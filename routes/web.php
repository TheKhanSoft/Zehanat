<?php

use Illuminate\Support\Facades\Route;

// Public website routes
Route::view('/', 'public.home')->name('home');
Route::view('/about', 'public.about')->name('about');
Route::view('/pillars', 'public.pillars')->name('pillars');
Route::view('/programs', 'public.programs')->name('programs');
Route::view('/membership', 'public.membership')->name('membership');
Route::get('/news-events', function () {
    $newsEvents = \App\Models\NewsEvent::published()->latest()->get();
    return view('public.news-events', compact('newsEvents'));
})->name('news-events');
Route::view('/resources', 'public.resources')->name('resources');
Route::get('/faq', function () {
    $faqs = \App\Models\Faq::active()->orderBy('sort_order')->get();
    return view('public.faq', compact('faqs'));
})->name('faq');
Route::view('/contact', 'public.contact')->name('contact');

// Public form submissions
Route::post('/membership', [\App\Http\Controllers\MembershipController::class, 'store'])->name('membership.store');
Route::post('/contact', [\App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
    
    Route::get('/members', [\App\Http\Controllers\Admin\MemberController::class, 'index'])->name('members.index');
    Route::get('/members/{member}', [\App\Http\Controllers\Admin\MemberController::class, 'show'])->name('members.show');
    Route::patch('/members/{member}/status', [\App\Http\Controllers\Admin\MemberController::class, 'updateStatus'])->name('members.status');
    
    Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class);
    Route::resource('news', \App\Http\Controllers\Admin\NewsEventController::class);
    
    Route::get('/contacts', [\App\Http\Controllers\Admin\ContactController::class, 'index'])->name('contacts.index');
    Route::get('/contacts/{contact}', [\App\Http\Controllers\Admin\ContactController::class, 'show'])->name('contacts.show');
    Route::patch('/contacts/{contact}/read', [\App\Http\Controllers\Admin\ContactController::class, 'markRead'])->name('contacts.read');
});

require __DIR__.'/settings.php';
