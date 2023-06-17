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
     * Show the form for reports.
     */
    public function report(Request $request)
    {
        $invoice = Invoice::with(['record'])
                   ->whereDate('created_at', $request->create_date)
                   ->get();

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

        return view('report/revenue');
    }


}
