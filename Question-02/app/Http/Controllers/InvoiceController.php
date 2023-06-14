<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Exception;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $invoice = Invoice::with(['record'])->get();

        if ($request->ajax()) {

        return Datatables::of($invoice)
                ->addIndexColumn()
                ->addColumn('name', function ($invoice) {
                    return $invoice->record->patient->name;
                })
                ->addColumn('mobile', function ($invoice) {
                    return $invoice->record->patient->mobile;
                })
                ->addColumn('created_at', function ($invoice) {
                    return $invoice->created_at;
                })
                ->rawColumns(['name','mobile','created_at'])
                ->make(true);
                }

        return view('invoice/list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
