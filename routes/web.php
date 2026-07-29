<?php

use App\Http\Controllers\Admin\MemberImpersonationController;
use App\Http\Controllers\Admin\UserImpersonationController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\SearchController;
use App\Livewire\Admin\ContactManager;
use App\Livewire\Admin\DashboardManager;
use App\Livewire\Admin\DeleteAccountVerify;
use App\Livewire\Admin\EmailTemplateManager;
use App\Livewire\Admin\FaqManager;
use App\Livewire\Admin\MemberManager;
use App\Livewire\Admin\NewsManager;
use App\Livewire\Admin\PermissionManager;
use App\Livewire\Admin\ProfileManager;
use App\Livewire\Admin\RoleManager;
use App\Livewire\Admin\UserManager;
use App\Models\Faq;
use App\Models\NewsEvent;
use Illuminate\Support\Facades\Route;

// Public website routes
Route::get('/search', [SearchController::class, 'index'])->name('search');
Route::view('/', 'public.home')->name('home');
Route::view('/about', 'public.about')->name('about');
Route::view('/pillars', 'public.pillars')->name('pillars');
Route::view('/programs', 'public.programs')->name('programs');
Route::view('/membership', 'public.membership')->name('membership');
Route::get('/news-events', function () {
    $newsEvents = NewsEvent::published()->latest()->get();

    return view('public.news-events', compact('newsEvents'));
})->name('news-events');
Route::view('/resources', 'public.resources')->name('resources');
Route::get('/faq', function () {
    $faqs = Faq::active()->orderBy('sort_order')->get();

    return view('public.faq', compact('faqs'));
})->name('faq');
Route::view('/contact', 'public.contact')->name('contact');

// Public form submissions
Route::post('/membership', [MembershipController::class, 'store'])->name('membership.store');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/member/portal', [MemberImpersonationController::class, 'show'])
        ->name('member.portal');
    Route::post('/member/impersonation/stop', [MemberImpersonationController::class, 'stop'])
        ->name('member.impersonation.stop');
    Route::post('/user/impersonation/stop', [UserImpersonationController::class, 'stop'])
        ->name('user.impersonation.stop');
});

// Admin routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    Route::get('/', DashboardManager::class)->name('dashboard');

    Route::get('/members', MemberManager::class)->name('members.index');
    Route::post('/members/{member}/impersonate', [MemberImpersonationController::class, 'start'])
        ->name('members.impersonate');

    Route::get('/users', UserManager::class)->name('users.index');
    Route::post('/users/{user}/impersonate', [UserImpersonationController::class, 'start'])
        ->name('users.impersonate');

    Route::get('/faqs', FaqManager::class)->name('faqs.index');

    Route::get('/news', NewsManager::class)->name('news.index');

    Route::get('/roles', RoleManager::class)->name('roles.index');

    Route::get('/permissions', PermissionManager::class)->name('permissions.index');

    Route::get('/contacts', ContactManager::class)->name('contacts.index');

    Route::get('/email-templates', EmailTemplateManager::class)->name('email-templates.index');

    Route::get('/profile', ProfileManager::class)->name('profile');
    Route::get('/profile/delete/{user}/verify', DeleteAccountVerify::class)->name('profile.delete.verify')->middleware('signed');
});

require __DIR__.'/settings.php';

// Keep unmatched browser requests inside the web middleware stack so custom
// error pages can safely resolve authenticated and impersonation destinations.
Route::fallback(static fn () => abort(404));
