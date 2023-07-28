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

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard', [
            'recent_compounds' => Auth::user()->compounds()->orderBy('created_at', 'desc')->limit(4)->get(),
            'search_results' => [],
        ]);
    })->name('dashboard');

    Route::name('profile.')->prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    Route::name('compound.')->prefix('compound')->group(function () {
        Route::get('/{compound:id}', [ChemicalStructureController::class, 'show'])->name('show');
    });

    Route::name('smile.')->prefix('smile')->group(function () {
        Route::post('/{text}', [ChemicalStructureController::class, 'store'])->name('store');
        Route::delete('/{text}', [ChemicalStructureController::class, 'destroy'])->name('destroy');
    });
});

require __DIR__.'/auth.php';
