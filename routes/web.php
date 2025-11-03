<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\InvoiceTemplateController;
use App\Models\Country;
use App\Models\Region;
use App\Models\Status;

Route::get('/', function () {
    return view('auth.login');
});

Route::delete('logout', fn() => to_route("auth.destroy"));
Route::delete('auth', [AuthenticatedSessionController::class, 'destroy'])->name("auth.destroy");


Route::get('/dashboard', function () {
    $region_names = Region::pluck('name', 'id');
    $status_names = Status::pluck('name', 'id');
    $all_country_names = Country::pluck('name', 'id');

    return view('dashboard', [
        'region_names' => $region_names,
        'status_names' => $status_names,
        'all_country_names' => $all_country_names

    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/invoice', [InvoiceTemplateController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('invoice.index');

Route::get('/invoice/create', [InvoiceTemplateController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('invoice.create');

Route::post('/invoice', [InvoiceTemplateController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('invoice.store');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
