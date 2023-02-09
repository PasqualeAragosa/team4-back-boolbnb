<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PropertyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\SponsorshipController;
use App\Models\Property;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MessageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::middleware(['auth', 'verified'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('properties', PropertyController::class)->parameters([
        'properties' => 'property:slug'
    ]);
    Route::resource('sponsorships', SponsorshipController::class)->except(['create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::resource('messages', MessageController::class)->except(['create', 'store', 'edit', 'update']);
});

require __DIR__ . '/auth.php';
