<?php

namespace App\Http\Controllers;

use App\Models\Patient;
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
        $record = Patient::all();

        if ($request->ajax()) {

        return Datatables::of($record)
                ->addIndexColumn()
                ->addColumn('name', function ($record) {
                    return $record->name;
                })
                ->addColumn('mobile', function ($record) {
                    return $record->mobile;
                })
                ->addColumn('view', function ($record) {
                    $btn = '<button type="button"  class="btn btn-primary py-1 px-1 viewData" data-bs-toggle="modal"
                    data-bs-target="#viewMdl" data-bs-toggle="dropdown"
                    aria-expanded="false" value = "' . $record->id . '">
                    <i class="fa fa-eye"></i></button>';

                    return $btn;
                })
                ->rawColumns(['name','mobile','view'])
                ->make(true);
                }

        return view('record/list');
    }

    public function tableLoad($id)
    {
        $record = Record::with(['patient' => function($query) use($id){
                    $query->find($id);
        }])->get();

        return Datatables::of($record)
            ->addIndexColumn()
            ->addColumn('created_at', function ($record) {
                return $record->created_at;
            })
            ->rawColumns(['created_at'])
            ->make(true);
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
