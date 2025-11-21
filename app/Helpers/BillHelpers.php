<?php

namespace App\Helpers;

use App\Models\Bill;
use App\Models\InvoiceTemplate;
use Illuminate\Support\Facades\Auth;

class BillHelpers
{
    public static function bill_generated($invoice_template, $month, $year)
    {
        $bill = Bill::where('invoice_template_id', $invoice_template->id)->first();
        if ($bill) {
            $bill_month = date_format(date_create($bill->due_date), 'n');
            $bill_year = date_format(date_create($bill->due_date), 'Y');
            if ($month == $bill_month && $year == $bill_year) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}
