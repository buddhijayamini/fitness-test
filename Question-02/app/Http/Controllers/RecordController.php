<?php

namespace App\Http\Controllers;

use App\Models\Record;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Exception;

class RecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $record = Record::with(['patient'])->get();

        if ($request->ajax()) {

        return Datatables::of($record)
                ->addIndexColumn()
                ->addColumn('name', function ($record) {
                    return $record->patient->name;
                })
                ->addColumn('mobile', function ($record) {
                    return $record->patient->mobile;
                })
                ->addColumn('created_at', function ($record) {
                    return $record->created_at;
                })
                ->rawColumns(['name','mobile','created_at'])
                ->make(true);
                }

        return view('record/list');
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
    public function show(Record $record)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Record $record)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Record $record)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Record $record)
    {
        //
    }
}
