<?php

namespace App\Helpers;

use App\Models\Bill;
use App\Models\InvoiceTemplate;
use Illuminate\Support\Facades\Auth;

class BillHelpers
{
    public static function bill_generated($invoice_template, $month, $year)
    {
        $bill_count = Bill::where('invoice_template_id', $invoice_template->id)
            ->whereYear('due_date', $year)
            ->whereMonth('due_date', $month)
            ->count();
        if ($bill_count > 0) {
            return true;
        } else {
            return false;
        }
    }
}
