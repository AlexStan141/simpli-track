<?php

namespace App\Http\Controllers;

use App\Http\Requests\InvoiceRequest;
use App\Models\InvoiceTemplate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class InvoiceTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_invoices = InvoiceTemplate::where('user_id', Auth::user()->id)->latest()->paginate(5);
        return view("invoice_template.index", [
            'user_invoices' => $user_invoices
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invoice_template.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(InvoiceRequest $request)
    {
        $invoice = InvoiceTemplate::create($request->validated());
        $invoice->lease_no = $invoice->lease_no ?? null;
        $invoice->amount = $invoice->amount ?? null;
        $invoice->currency = $invoice->currency ?? null;
        $invoice->landlord_id = $invoice->landlord_id ?? null;
        return redirect()->route('invoice.index')->with('success', 'Invoice added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
