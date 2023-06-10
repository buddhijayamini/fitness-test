<?php

namespace App\Http\Controllers;

use App\Models\Dish;
use Exception;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Validator;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $dish = Dish::all();

        if ($request->ajax()) {

        return Datatables::of($dish)
                ->addIndexColumn()
                ->make(true);
                }

        return view('dishes/list');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dishes/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validator =  Validator::make($request->all(), [
                "type" => "required",
                "name" => "required",
                "price" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 500,
                    'message' => "Validation Error"
                ]);
            }

            DB::beginTransaction();
            $data = Dish::create([
                'type' => $request->type,
                'name' => $request->name,
                'price' => $request->price
            ]);
            DB::commit();

            if ($data) {
                return response()->json(
                    [
                        'status' => 200,
                        'message' => "Create Dish Successfully!"
                    ],
                );
            } else {
                return  response()->json(
                    [
                        'status' => 500,
                        'message' => "Create Dish Error"
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
}
