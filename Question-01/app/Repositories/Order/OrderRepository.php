<?php

namespace App\Repositories\Order;

use App\Models\Dish;
use App\Models\Order;
use App\Models\OrderList;
use JasonGuru\LaravelMakeRepository\Repository\BaseRepository;
//use Your Model

/**
 * Class OrderRepository.
 */
class OrderRepository implements OrderInterface
{
    public function getPaginated(): object
    {
      $order =  Order::with(['customer'])
                ->get();

        return $order;
    }

    public function getListPaginated($id)
    {
      $list =  OrderList::with(['order','dish'])
                 ->where('order_id', $id)
                ->get();

        return $list;
    }

    public function getById(int $orderId)
    {
        return Order::find($orderId);
    }

    public function store(array $OrderDetails): object
    {
       $ord = Order::create([
            'code'=>$OrderDetails['code'],
            'customer_id'=>$OrderDetails['customer_id'],
            'total'=> 0
        ]);

        return $ord;
    }

    public function storeList(array $OrderDetails): object
    {
       $dish = Dish::where('name', $OrderDetails['dish_name'])->first();
       $list =  OrderList::create([
            'order_id' => $OrderDetails['order_id'],
            'dish_id'=> $dish->id,
            'qty'=> $OrderDetails['qty'],
            'price'=> $OrderDetails['price']
        ]);

       $tot = OrderList::where('order_id', $OrderDetails['order_id'])->sum('price');
        Order::where('id', $OrderDetails['order_id'])->update([
            'total' => $tot,
        ]);
        return $list;
    }

    public function update(int $orderId, array $newDetails) : bool
    {
        return Order::whereId($orderId)->update($newDetails);
    }
}
