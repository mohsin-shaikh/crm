<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

// use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\OrganizationsController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\UsersController;

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
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

// Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->name('dashboard');

// Route::middleware(['auth:sanctum', 'verified'])->get('/organizations', function () {
//     return Inertia::render('Dashboard');
// })->name('organizations');

// Route::middleware(['auth:sanctum', 'verified'])->get('/contacts', function () {
//     return Inertia::render('Dashboard');
// })->name('contacts');

// Route::middleware(['auth:sanctum', 'verified'])->get('/reports', function () {
//     return Inertia::render('Dashboard');
// })->name('reports');



// Dashboard
Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Users
Route::middleware(['auth:sanctum', 'verified', 'remember'])->get('users', [UsersController::class, 'index'])
    ->name('users');

Route::middleware(['auth:sanctum', 'verified'])->get('users/create', [UsersController::class, 'create'])
    ->name('users.create');

Route::middleware(['auth:sanctum', 'verified'])->post('users', [UsersController::class, 'store'])
    ->name('users.store');

Route::middleware(['auth:sanctum', 'verified'])->get('users/{user}/edit', [UsersController::class, 'edit'])
    ->name('users.edit');

Route::middleware(['auth:sanctum', 'verified'])->put('users/{user}', [UsersController::class, 'update'])
    ->name('users.update');

Route::middleware(['auth:sanctum', 'verified'])->delete('users/{user}', [UsersController::class, 'destroy'])
    ->name('users.destroy');

Route::middleware(['auth:sanctum', 'verified'])->put('users/{user}/restore', [UsersController::class, 'restore'])
    ->name('users.restore');

// Organizations
Route::middleware(['auth:sanctum', 'verified', 'remember'])->get('organizations', [OrganizationsController::class, 'index'])
    ->name('organizations');

Route::middleware(['auth:sanctum', 'verified'])->get('organizations/create', [OrganizationsController::class, 'create'])
    ->name('organizations.create');

Route::middleware(['auth:sanctum', 'verified'])->post('organizations', [OrganizationsController::class, 'store'])
    ->name('organizations.store');

Route::middleware(['auth:sanctum', 'verified'])->get('organizations/{organization}/edit', [OrganizationsController::class, 'edit'])
    ->name('organizations.edit');

Route::middleware(['auth:sanctum', 'verified'])->put('organizations/{organization}', [OrganizationsController::class, 'update'])
    ->name('organizations.update');

Route::middleware(['auth:sanctum', 'verified'])->delete('organizations/{organization}', [OrganizationsController::class, 'destroy'])
    ->name('organizations.destroy');

Route::middleware(['auth:sanctum', 'verified'])->put('organizations/{organization}/restore', [OrganizationsController::class, 'restore'])
    ->name('organizations.restore');

// Contacts
Route::middleware(['auth:sanctum', 'verified', 'remember'])->get('contacts', [ContactsController::class, 'index'])
    ->name('contacts');

Route::middleware(['auth:sanctum', 'verified'])->get('contacts/create', [ContactsController::class, 'create'])
    ->name('contacts.create');

Route::middleware(['auth:sanctum', 'verified'])->post('contacts', [ContactsController::class, 'store'])
    ->name('contacts.store');

Route::middleware(['auth:sanctum', 'verified'])->get('contacts/{contact}/edit', [ContactsController::class, 'edit'])
    ->name('contacts.edit');

Route::middleware(['auth:sanctum', 'verified'])->put('contacts/{contact}', [ContactsController::class, 'update'])
    ->name('contacts.update');

Route::middleware(['auth:sanctum', 'verified'])->delete('contacts/{contact}', [ContactsController::class, 'destroy'])
    ->name('contacts.destroy');

Route::middleware(['auth:sanctum', 'verified'])->put('contacts/{contact}/restore', [ContactsController::class, 'restore'])
    ->name('contacts.restore');

// Reports
Route::middleware(['auth:sanctum', 'verified'])->get('reports', [ReportsController::class, 'index'])
    ->name('reports');

// Images
Route::get('/img/{path}', [ImagesController::class, 'show'])->where('path', '.*');

// 500 error
Route::get('500', function () {
    // Force debug mode for this endpoint in the demo environment
    if (App::environment('demo')) {
        Config::set('app.debug', true);
    }
    echo $fail;
});
