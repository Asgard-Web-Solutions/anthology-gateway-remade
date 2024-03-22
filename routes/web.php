<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\AnthologyController;
use Illuminate\Support\Facades\Auth;
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

Route::view('/', 'welcome');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware(['auth', 'verified']);

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('/users', [UserController::class, 'index'])->name('users');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}/update', [UserController::class, 'update'])->name('users.update');

Route::get('/socials', \App\Livewire\SocialIndex::class)->name('socials');
Route::get('/socials/{id}/edit', [SocialController::class, 'edit'])->name('socials.edit');
Route::put('/socials/{id}/update', [SocialController::class, 'update'])->name('socials.update');
Route::post('/socials/add', [SocialController::class, 'store'])->name('socials.store');

Route::get('/anthology/create', [AnthologyController::class, 'create'])->name('anthology.create');
Route::post('/anthology/store', [AnthologyController::class, 'store'])->name('anthology.store');

Route::get('/publishers', [PublisherController::class, 'index'])->name('publishers');
Route::get('/publisher/new', [PublisherController::class, 'info'])->name('publisher.create');
Route::get('/publisher/new/create', [PublisherController::class, 'create'])->name('publisher.create-detail');
Route::post('/publisher/save', [PublisherController::class, 'store'])->name('publisher.store');
Route::get('/publisher/{id}', [PublisherController::class, 'show'])->name('publisher.view');
Route::get('/publisher/{id}/edit', [PublisherController::class, 'edit'])->name('publisher.edit');
Route::post('/publisher/{id}/update', [PublisherController::class, 'update'])->name('publisher.update');
Route::get('/publisher/{id}/social-media', [PublisherController::class, 'socials'])->name('publisher.socials');
Route::post('/publisher/{id}/social-add', [PublisherController::class, 'social_add'])->name('publisher.social_add');
Route::get('/publisher/{publisher_id}/social-edit/{social_id}', [PublisherController::class, 'social_edit'])->name('publisher.social_edit');
Route::post('/publisher/{publisher_id}/social-update', [PublisherController::class, 'social_update'])->name('publisher.social_update');
Route::get('/publisher/{publisher_id}/social-delete/{social_id}', [PublisherController::class, 'social_delete'])->name('publisher.social_delete');
Route::get('/publisher/{publisher_id}/social-delete-confirm/{social_id}', [PublisherController::class, 'social_delete_confirm'])->name('publisher.social_delete_confirm');

Route::get('/settings', [HomeController::class, 'index'])->name('settings');

Route::get('/logout', function () {
    Auth::logout();

    return redirect()->route('login');
})->name('logout');

require __DIR__.'/auth.php';
