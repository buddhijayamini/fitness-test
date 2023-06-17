<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Patient;
use App\Models\Record;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Exception;
use Validator;
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
        $record = Patient::select('records.note','records.created_at')
        ->join('records','patients.id','records.patient_id')
            //   with(['record' => function ($query) use ($id) {
            //         $query->where('patient_id','=', $id);
            //     }])
            ->where('records.patient_id', $id)
               ->get();

        return Datatables::of($record)
            ->addIndexColumn()
            // ->addColumn('note', function ($record) {
            //     return $record->record->note;
            // })
            ->addColumn('created_at', function ($record) {
                return ($record->created_at)->format('Y-m-d');
            })
            ->rawColumns(['created_at'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('record/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator =  Validator::make($request->all(), [
                "mobile" => "required",
                "name" => "required",
                "birthday" => "required",
                "nic" => "required",
                "record" => "required",
                "amount" => "required",
                'photo' => 'image|mimes:png,jpg,jpeg|max:2048'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 500,
                    'message' => "Validation Error"
                ]);
            }

            $invLastId = Invoice::all()->last();

            if ($invLastId == null) {
                $invCode = 'INV' . '001';
            } else {
                $invCode = 'INV' . '00' . ($invLastId->id + 1);
            }

            $imageName = $invCode.'.'.$request->photo->extension();

            $request->photo->move(public_path('photo'), $imageName);

            DB::beginTransaction();
            $data = Patient::create([
                'mobile' => $request->mobile,
                'name' => $request->name,
                'birthday' => $request->birthday,
                'nic' => $request->name,
                'photo' => $imageName,
            ]);

            $data1 = Record::create([
                'patient_id' => $data->id,
                'note' => $request->record,
            ]);

            $data2 = Invoice::create([
                'record_id' => $data1->id,
                'code' => $invCode,
                'description' => $request->description,
                'amount' => $request->amount,
            ]);

            DB::commit();

            if ($data) {
                return response()->json(
                    [
                        'status' => 200,
                        'message' => "Create Record Successfully!"
                    ],
                );
            } else {
                return  response()->json(
                    [
                        'status' => 500,
                        'message' => "Create Record Error"
                    ],
                );
            }
        } catch (Exception $e) {
            return  response()->json(
                [
                    'status' => 500,
                    'message' => $e
                ],
            );
        }
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
