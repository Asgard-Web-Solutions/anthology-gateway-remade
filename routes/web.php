<?php

use App\Http\Controllers\AnthologyController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublisherController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
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

Route::get('/', [HomeController::class, 'welcome'])->name('welcome');

Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard')->middleware(['auth', 'verified']);

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
    
Route::prefix('users')->name('users.')->controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::put('/{id}/update', 'update')->name('update');
});

Route::get('/socials', \App\Livewire\SocialIndex::class)->name('socials');
Route::prefix('socials')->name('socials.')->controller(SocialController::class)->middleware('auth')->group(function () {
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::put('/{id}/update', 'update')->name('update');
    Route::post('/add', 'store')->name('store');
});

Route::get('/browse', [AnthologyController::class, 'list'])->name('anthology.list');
Route::get('/anthologies', [AnthologyController::class, 'index'])->name('anthologies');
Route::prefix('anthology')->name('anthology.')->controller(AnthologyController::class)->middleware('auth')->group(function () {
    Route::get('/create', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{id}/manage', 'manage')->name('manage');
    Route::get('/{id}/manage/{setting}', 'edit')->name('edit');
    Route::post('/{id}/update', 'update')->name('update');
    Route::get('/{id}/launch', 'launch')->name('launch');
    Route::get('/{id}/launch/confirm', 'launch_confirm')->name('launch_confirm');
});
Route::get('/anthology/{id}', [AnthologyController::class, 'show'])->name('anthology.view');

Route::get('/publishers', [PublisherController::class, 'index'])->name('publishers');
Route::prefix('publisher')->name('publisher.')->controller(PublisherController::class)->middleware('auth')->group(function () {
    Route::get('/new', 'info')->name('create');
    Route::get('/new/create', 'create')->name('create-detail');
    Route::post('/save', 'store')->name('store');
    Route::get('/{id}/edit', 'edit')->name('edit');
    Route::post('/{id}/update', 'update')->name('update');
    Route::get('/{id}/social-media', 'socials')->name('socials');
    Route::post('/{id}/social-add', 'social_add')->name('social_add');
    Route::get('/{publisher_id}/social-edit/{social_id}', 'social_edit')->name('social_edit');
    Route::post('/{publisher_id}/social-update', 'social_update')->name('social_update');
    Route::get('/{publisher_id}/social-delete/{social_id}', 'social_delete')->name('social_delete');
    Route::get('/{publisher_id}/social-delete-confirm/{social_id}', 'social_delete_confirm')->name('social_delete_confirm');
});
Route::get('/{publisher_id}/new-anthology', [AnthologyController::class, 'create'])->name('publisher.create_anthology');
Route::get('/publisher/{id}', [PublisherController::class, 'show'])->name('publisher.view');

Route::prefix('author')->name('author.')->controller(AuthorController::class)->middleware('auth')->group(function () {
    Route::get('/new', 'create')->name('create');
    Route::post('/store', 'store')->name('store');
    Route::get('/{author}', 'show')->name('view');
    Route::get('/{author}/edit', 'edit')->name('edit');
    Route::post('/{author}/update', 'update')->name('update');
});

Route::get('/settings', [HomeController::class, 'index'])->name('settings');

Route::get('/logout', function () {
    Auth::logout();

    return redirect()->route('login');
})->name('logout');

require __DIR__.'/auth.php';
