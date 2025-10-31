<?php

use App\Http\Controllers\Auth;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Common;
use App\Http\Controllers\Ngo;
use App\Http\Controllers\People;
use App\Http\Controllers\Website;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// For authentication routes
require __DIR__ . '/auth.php';

Route::get('/', function () {
    if (!auth()->check()) {
        return view('welcome');
    }

    // If logged in as role 1 or 2, show feed to the user
    if (in_array(auth()->user()->role_id, [1, 2])) {
        return app(\App\Http\Controllers\Common\FeedController::class)->index();
    }

    return redirect()->route('admin.dashboard');
})->name('root');


Route::middleware('auth')->group(function () {

    Route::get('/switch-to-ngo/{ngo_id}', [Auth\SettingController::class, 'switchToNgo'])->middleware('role:2')->name('switch.to.ngo');
    Route::get('/switch-back', [Auth\SettingController::class, 'switchBack'])->name('switch.back');

    // Admin routes 
    Route::middleware('role:0')->prefix('admin')->group(function () {

        Route::get('/',[Admin\DashboardController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/dashboard', [Admin\DashboardController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/ngos/{id}', [Admin\NgoController::class, 'show'])->name('admin.ngos.show');
        Route::post('/ngos/{id}/verify', [Admin\NgoController::class, 'verifyNgo'])->name('admin.ngos.verify');
        Route::post('/ngos/{id}/reject', [Admin\NgoController::class, 'rejectNgo'])->name('admin.ngos.reject');

        Route::get('/ngos', [Admin\NgoController::class, 'showNgos'])->name('admin.ngos');

        // Routes related to logs
        Route::get('/log', [Admin\LogController::class, 'showLog'])->name('admin.log');

    });

    // NGO routes
    Route::middleware('role:1')->prefix('ngo')->group(function () {

        // Route::get('/profile', [Ngo\NgoController::class, 'show'])->name('ngo.profile');
        Route::get('/profile/edit', [Ngo\NgoController::class, 'edit'])->name('ngo.profile.edit');
        Route::put('/profile', [Ngo\NgoController::class, 'update'])->name('ngo.profile.update');

        Route::get('/events', [Ngo\EventController::class, 'events'])->name('ngo.events');
        Route::get('/events/create', [Ngo\EventController::class, 'createEvent'])->name('ngo.events.create');
        Route::post('/events', [Ngo\EventController::class, 'storeEvent'])->name('ngo.events.store');

        Route::get('/volunteers', [Ngo\VolunteerController::class, 'volunteers'])->name('ngo.volunteers');
        Route::post('/volunteers/{eventId}/{userId}/verify', [Ngo\VolunteerController::class, 'verifyVolunteer'])->name('ngo.volunteers.verify');

        Route::get('/donations', [Ngo\DonationController::class, 'donations'])->name('ngo.donations');
        Route::post('/donations/{donationId}/verify', [Ngo\DonationController::class, 'verifyDonation'])->name('ngo.donations.verify');

        Route::get('/notifications', [Ngo\NotificationController::class, 'notifications'])->name('ngo.notifications');
        Route::post('/notifications/{id}/read', [Ngo\NotificationController::class, 'markAsRead'])->name('ngo.notifications.read');

        Route::get('/dashboard', function () {
            return view('ngo.dashboard');
        })->name('dashboard');
    });

    // People routes
    Route::middleware('role:2')->prefix('people')->group(function () {
        // User Profile Routes
        Route::get('/profile', [People\ProfileController::class, 'show'])->name('people.profile');
        Route::get('/profile/edit', [People\ProfileController::class, 'edit'])->name('people.profile.edit');
        Route::put('/profile', [People\ProfileController::class, 'update'])->name('people.profile.update');

        // Newsfeed Routes
        Route::get('/newsfeed', [People\NewsfeedController::class, 'index'])->name('people.newsfeed');

        // Volunteer Opportunities Routes
        Route::get('/volunteer/opportunities', [People\VolunteerController::class, 'index'])->name('people.volunteer.opportunities');
        Route::post('/volunteer/apply', [People\VolunteerController::class, 'apply'])->name('people.volunteer.apply');

        // Donations Routes
        // Route::get('/donations', [People\DonationController::class, 'index'])->name('people.donations');
        // Route::post('/donate/payment', [People\DonationController::class, 'showPaymentForm'])->name('donations.payment.request');
        // Route::get('/donation/payment/success', [People\DonationController::class, 'paymentSuccess'])->name('payment.success');
        // Route::get('/donation/payment/fail', [People\DonationController::class, 'paymentFail'])->name('payment.fail');

        Route::get('/donations', [People\DonationController::class, 'index'])->name('people.donations');

        // Notifications Routes
        Route::get('/notifications', [People\NotificationController::class, 'index'])->name('people.notifications');
        Route::post('/notifications/{id}/read', [People\NotificationController::class, 'markAsRead'])->name('people.notifications.read');

        Route::get('/ngo/register', [People\NgoRegisterController::class, 'showRegistrationForm'])->name('people.ngo.register.form');
        Route::post('/ngo/register', [People\NgoRegisterController::class, 'register'])->name('people.ngo.register');

        // NGO Profile Routes
        Route::get('/ngo/{id}', [People\NgoProfileController::class, 'show'])->name('people.ngo.profile');
        Route::post('/ngo/{id}/favorite', [People\NgoProfileController::class, 'toggleFavorite'])->name('people.ngo.favorite');
    });

    // Shared routes (ngo and people, role_id=1,2)
    Route::middleware('role:1,2')->group(function () {
        Route::get('/feed', [Common\FeedController::class, 'index'])->name('common.feed');
        Route::post('/feed', [Common\FeedController::class, 'create'])->name('common.post.create');
        Route::get('/ngo/profile/{id}', [Common\NgoProfileController::class, 'index'])->name('common.ngo.profile');
        Route::post('/post/like', [Common\FeedController::class, 'like'])->name('common.post.like');
        Route::post('/post/comment', [Common\FeedController::class, 'comment'])->name('common.post.comment');
        Route::post('/post/report', [Common\FeedController::class, 'report'])->name('common.post.report');
        Route::post('/ngo/follow', [Common\FeedController::class, 'follow'])->name('common.ngo.follow');
        Route::get('/ngos/search', [People\NgoSearchController::class, 'index'])->name('people.ngo.search');
    });
});

// Route::get('/privacy', [Website\StaticPageController::class, 'privacy'])->name('privacy');
// Route::get('/terms', [Website\StaticPageController::class, 'terms'])->name('terms');
// Route::get('/advertising', [Website\StaticPageController::class, 'advertising'])->name('advertising');
// Route::get('/cookies', [Website\StaticPageController::class, 'cookies'])->name('cookies');
// Route::get('/more', [Website\StaticPageController::class, 'more'])->name('more');