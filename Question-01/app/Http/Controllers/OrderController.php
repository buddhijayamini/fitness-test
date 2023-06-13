<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderList;
use App\Repositories\Order\OrderInterface;
use Exception;
use Illuminate\Http\Request;
use DB;
use DataTables;
use Validator;

class OrderController extends Controller
{
    protected $orderInterface;

    public function __construct(OrderInterface $orderInterface)
    {
        $this->orderInterface = $orderInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $data =  $this->orderInterface->getPaginated();
        if ($request->ajax()) {

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('customer_name', function ($row) {
                    return $row->customer->name;
                })
                ->addColumn('address', function ($row) {
                    return $row->customer->address;
                })
                ->addColumn('mobile', function ($row) {
                    return $row->customer->mobile;
                })
                ->addColumn('view', function ($row) {
                    $btn = '<button type="button"  class="btn btn-primary py-1 px-1 viewData" data-bs-toggle="modal"
                    data-bs-target="#viewMdl" data-bs-toggle="dropdown"
                    aria-expanded="false" value = "' . $row->id . '">
                    <i class="fa fa-eye"></i></button>';

                    return $btn;
                })
                ->rawColumns(['customer_name', 'address', 'mobile', 'view'])
                ->make(true);
        }

        return view('orders/list');
    }

    public function tableLoad($id)
    {
        $list =  $this->orderInterface->getListPaginated($id);

        return Datatables::of($list)
            ->addIndexColumn()
            ->addColumn('dish', function ($list) {
                return $list->dish->type . " - " . $list->dish->name;
            })
            ->rawColumns(['dish'])
            ->make(true);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders/create');
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
                "address" => "required",
                "tblData" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'status' => 500,
                    'message' => "Validation Error"
                ]);
            }

            $ordLastId = Order::all()->last();

            if ($ordLastId == null) {
                $ordCode = 'ORD' . '001';
            } else {
                $ordCode = 'ORD' . '00' . ($ordLastId->id + 1);
            }

            DB::beginTransaction();
            $data = Customer::create([
                'mobile' => $request->mobile,
                'name' => $request->name,
                'address' => $request->address
            ]);

            $dt = [];
            $dt["customer_id"] = $data->id;
            $dt["code"] = $ordCode;
            $ord = $this->orderInterface->store($dt);

            $tbl = $request->tblData;

            foreach ($tbl as $set) {
                // $dishId = Dish::where("name", 'like', '%' .$set[1] . '%')->fist();
                $dt["order_id"] = $ord->id;
                $dt["dish_name"] = $set[1];
                $dt["qty"] = $set[2];
                $dt["price"] = $set[3];
                $this->orderInterface->storeList($dt);
            }
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

    public function dailyOrdersTbl(Request $request)
    {
        $orders = Order::with(['customer'])
            ->whereDate('created_at', $request->create_date)->get();

        if ($request->ajax()) {

            return Datatables::of($orders)
                ->addIndexColumn()
                ->addColumn('customer_name', function ($row) {
                    return $row->customer->name;
                })
                ->addColumn('address', function ($row) {
                    return $row->customer->address;
                })
                ->addColumn('mobile', function ($row) {
                    return $row->customer->mobile;
                })
                ->rawColumns(['customer_name', 'address', 'mobile'])
                ->make(true);
        }

        return view('reports/daily_sale');
    }

    public function famousDishTbl(Request $request)
    {
        $dish =  OrderList::join('dishes','order_lists.dish_id','dishes.id')
        // with(['dish' => function ($query) {
        //                  $query->where('type', 'Main Dishes');
        //              }])
                ->where('dishes.type', 'Main Dishes')
                ->groupBy('order_lists.dish_id')
                ->orderBy('order_lists.qty', 'desc')
                ->get();

        if ($request->ajax()) {

            return Datatables::of($dish)
                ->addIndexColumn()
                ->addColumn('dish', function ($dish) {
                    return $dish->name;
                })
                ->addColumn('price', function ($dish) {
                    return $dish->price;
                })
                ->addColumn('qty', function ($dish) {
                    return $dish->qty;
                })
                ->rawColumns(['dish', 'price', 'qty'])
                ->make(true);
        }

        return view('reports/main_dish');
    }

    public function famousSideDishTbl(Request $request)
    {
        $dish =  OrderList::join('dishes','order_lists.dish_id','dishes.id')
                ->where('dishes.type', 'Side Dishes')
                ->groupBy('order_lists.dish_id')
                ->orderBy('order_lists.qty', 'desc')
                ->get();

        if ($request->ajax()) {

            return Datatables::of($dish)
                ->addIndexColumn()
                ->addColumn('dish', function ($dish) {
                    return $dish->name;
                })
                ->addColumn('price', function ($dish) {
                    return $dish->price;
                })
                ->addColumn('qty', function ($dish) {
                    return $dish->qty;
                })
                ->rawColumns(['dish', 'price', 'qty'])
                ->make(true);
        }

        return view('reports/side_dish');
    }


   public function dishByType($type)
    {
        $data = Dish::where('type', $type)->get();

        return  response()->json(
            [
                'status' => 200,
                'data' => $data
            ],
        );
    }

    public function dishByName($name)
    {
        $data = Dish::where('name', $name)->first();

        return  response()->json(
            [
                'status' => 200,
                'data' => $data
            ],
        );
    }
}
