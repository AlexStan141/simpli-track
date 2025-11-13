<?php

namespace App\Services;

use App\Models\Company;
use Illuminate\Http\UploadedFile;

class CompanyService
{
    public function updateCompany(Company $company, array $data)
    {
        if (isset($data['logo']) && $data['logo'] instanceof UploadedFile) {
            $path = $data['logo']->store('logos', 'public');
            $company->logo = $path;
        }

        $company->fill([
            'name' => $data['name'],
            'address' => $data['address'],
            'default_currency' => $data['default_currency'],
            'display_invoice_amount' => $data['display_invoice_amount'],
        ])->save();
    }
}
