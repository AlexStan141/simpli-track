<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use Illuminate\Http\Request;

class BillController extends Controller
{
    public function edit($bill_id){
        return view('bill.edit', ['bill_id' => $bill_id]);
    }
}
