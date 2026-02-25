<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::orderBy('created_at', 'desc')->paginate(20);
        return view('admin-layouts.invoices.index', compact('invoices'));
    }

    public function show($id)
    {
        $invoice = Invoice::with('items')->findOrFail($id);
        return view('admin-layouts.invoices.show', compact('invoice'));
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();
        return redirect()->back()->with('success', 'Invoice deleted successfully');
    }
}
