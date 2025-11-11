<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\InvoiceTemplateController;
use App\Http\Requests\CompanyRequest;
use App\Models\Category;
use App\Models\City;
use App\Models\Company;
use App\Models\Country;
use App\Models\Region;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('auth.login');
});

Route::delete('logout', fn() => to_route("auth.destroy"));
Route::delete('auth', [AuthenticatedSessionController::class, 'destroy'])->name("auth.destroy");


Route::get('/dashboard', function () {
    $region_ids = Auth::user()->company->companyRegions->pluck('region_id');
    $regions = Region::whereIn('id', $region_ids);
    $region_names = $regions->pluck('name');
    $status_names = Status::pluck('name', 'id')->toArray();
    $city_names = City::pluck('name', 'id')->toArray();
    $category_names = Category::pluck('name', 'id')->toArray();

    return view('dashboard', [
        'region_names' => $region_names,
        'status_names' => [...$status_names, 'All'],
        'city_names' => [...$city_names, 'All'],
        'category_names' => [...$category_names, 'All']

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

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/settings/company', function () {
        $user = Auth::user();
        return view('settings', ['page' => 'Company',
            'company_name' => $user->company->name,
            'company_address' => $user->company->address
        ]);
    });
    Route::get('/settings/users/{user}', function (User $user) {
        return view('settings', ['page' => 'Users & Roles']);
    })->name('settings.users');
    Route::get('/settings/priority', function () {
        return view('settings', ['page' => 'Priority']);
    })->name('settings.priority');
    Route::get('/settings/categories', function () {
        return view('settings', ['page' => 'Categories']);
    })->name('settings.categories');
    Route::get('/settings/statuses', function () {
        return view('settings', ['page' => 'Statuses']);
    })->name('settings.statuses');
    Route::get('/settings/locations', function () {
        return view('settings', ['page' => 'Regions & Locations']);
    })->name('settings.locations');
});



require __DIR__ . '/auth.php';
