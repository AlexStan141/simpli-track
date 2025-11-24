<?php

use App\Helpers\BillHelpers;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\InvoiceTemplateController;
use Illuminate\Support\Facades\Request;
use App\Models\Category;
use App\Models\City;
use App\Models\Region;
use App\Models\Status;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UploadController;
use App\Livewire\CompanySettings;
use App\Models\Bill;
use App\Models\InvoiceTemplate;

Route::get('/company-settings', CompanySettings::class)->name('company.settings');
Route::get('/', function () {
    return view('auth.login');
});

Route::delete('logout', fn() => to_route("auth.destroy"));
Route::delete('auth', [AuthenticatedSessionController::class, 'destroy'])->name("auth.destroy");


Route::get('/dashboard', function () {
    $regions = Auth::user()->company->regions;
    $region_names = $regions->pluck('name');
    $status_names = Status::where('company_id', Auth::user()->company_id)->pluck('name', 'id')->toArray();
    $city_names = City::pluck('name', 'id')->toArray();
    $company_id = Auth::user()->company_id;
    $category_names = Category::where('company_id', $company_id)->pluck('name', 'id')->toArray();
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

Route::get('/bills', function () {
    $invoice_templates = InvoiceTemplate::where('user_id', Auth::user()->id)->get();
    $today = date_format(new DateTime(), 'j');
    $this_month = date_format(new DateTime(), 'n');
    $this_year = date_format(new DateTime(), 'Y');
    $new_bills = false;
    if ($today == 1) {
        foreach ($invoice_templates as $invoice_template) {
            if (!BillHelpers::bill_generated($invoice_template, $this_month, $this_year)) {
                $new_bills = true;
                $day = $invoice_template->due_day_id;
                Bill::create([
                    'invoice_template_id' => $invoice_template->id,
                    'status_id' => Status::where('name', 'Pending')->first()->id,
                    'due_date' => date_create($this_year . '-' . $this_month . '-' . $day)
                ]);
            }
        }
        if (!$new_bills) {
            return view('bill.index', [
                'message' => 'Bills already generated for this month. Come back on 1st day of the next month.',
                'generated' => false
            ]);
        } else {
            return view('bill.index', [
                'message' => 'Bills for this month generated. Waiting for pay.',
                'generated' => true
            ]);
        }
    } else {
        return view('bill.index', [
            'message' => 'Bills already generated for this month. Come back on 1st day of the next month.',
            'generated' => false
        ]);
    }
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
