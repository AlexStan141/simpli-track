<?php

use App\Helpers\BillHelpers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\InvoiceTemplateController;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Request;
use App\Models\Category;
use App\Models\City;
use App\Models\Region;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadController;
use App\Jobs\CreateBills;
use App\Livewire\CompanySettings;
use App\Models\Bill;
use App\Models\InvoiceTemplate;
use App\Models\Note;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

Route::get('/company-settings', CompanySettings::class)->name('company.settings');
Route::get('/', function () {
    return redirect()->route('login');
});

Route::delete('logout', fn(): RedirectResponse => to_route("auth.destroy"));
Route::delete('auth', [AuthenticatedSessionController::class, 'destroy'])->name("auth.destroy");


Route::get('/dashboard', function () {
    $region_names = Region::pluck('name');
    $status_names = Status::where('company_id', Auth::user()->company_id)->pluck('name', 'id')->toArray();
    $city_names = City::pluck('name', 'id')->toArray();
    $company_id = Auth::user()->company_id;
    $category_names = Category::where('company_id', $company_id)->pluck('name', 'id')->toArray();
    CreateBills::dispatch();
    return view('dashboard', [
        'region_names' => $region_names,
        'status_names' => ['All', ...$status_names],
        'city_names' => ['All', ...$city_names],
        'category_names' => ['All', ...$category_names]
    ]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/test', function () {
    return view('test');
});

Route::get('/invoices', [InvoiceTemplateController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('invoice.index');

Route::get('/invoices/create', [InvoiceTemplateController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('invoice.create');

Route::post('/invoices', [InvoiceTemplateController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('invoice.store');

Route::get('/invoices/{initialInvoice}/edit', [InvoiceTemplateController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('invoice.edit');

Route::put('/invoices/{initialInvoice}', [InvoiceTemplateController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('invoice.update');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::match(['GET', 'POST'], '/settings/company', function () {
        return view('settings', ['page' => 'Company']);
    })->name('settings.company');
    Route::get('/settings/users', function () {
        return view('settings', ['page' => 'Users & Roles']);
    })->name('settings.users');
    // Route::get('/settings/priority', function () {
    //     return view('settings', ['page' => 'Priority']);
    // })->name('settings.priority');
    Route::get('/settings/currencies', function () {
        return view('settings', ['page' => 'Currencies']);
    })->name('settings.currencies');
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

Route::get('/notes/{bill_id}/create', [NoteController::class, 'create'])
    ->middleware(['auth', 'verified'])->name('note.create');

Route::post('/notes/{bill_id}', [NoteController::class, 'store'])
    ->middleware(['auth', 'verified'])->name('note.store');

Route::get('/notes/{bill_id}', [NoteController::class, 'show'])
    ->middleware(['auth', 'verified'])->name('note.show');

Route::get('/notes/{bill_id}/edit', [NoteController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('note.edit');

Route::put('/notes/{bill_id}', [NoteController::class, 'update'])
    ->middleware(['auth', 'verified'])->name('note.update');

Route::delete('/notes/{bill_id}', [NoteController::class, 'delete'])
    ->middleware(['auth', 'verified'])->name('note.destroy');

Route::get('/bills/{bill_id}/edit', [BillController::class, 'edit'])
    ->middleware(['auth', 'verified'])->name('bill.edit');


Route::get("/alerts", function(){
    return view('alerts.index');
});

Route::get("/help", function(){
    return view('not-found', [
        'active_link' => '/help'
    ]);
});

Route::fallback(function () {
    return view('not-found', [
        'active_link' => '/notfound'
    ]);
});

require __DIR__ . '/auth.php';
