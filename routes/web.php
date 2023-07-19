<?php

use App\Http\Controllers\ChemicalStructureController;
use App\Http\Controllers\CompoundController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', [
        'recent_compounds' => Auth::user()->compounds()->orderBy('created_at', 'desc')->limit(4)->get(),
        'search_results' => [],
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/compound/{compound:id}', [ChemicalStructureController::class, 'show'])->name('compound.show');

    Route::get('/search/{text}', [CompoundController::class, 'search'])->name('search');
});

Route::post('/smile/{text}', [ChemicalStructureController::class, 'store'])->name('store');
Route::delete('/smile/{text}', [ChemicalStructureController::class, 'destroy'])->name('destroy');

require __DIR__.'/auth.php';
