<?php

namespace App\Http\Controllers;
use App\Models\Company;
use App\Services\CompanyService;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function update(Request $request, Company $company, CompanyService $service)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'default_currency' => 'required|string',
            'display_invoice_amount' => 'required|boolean',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:204800'
        ]);

        $service->updateCompany($company, $validated);

        return back();
    }
}
