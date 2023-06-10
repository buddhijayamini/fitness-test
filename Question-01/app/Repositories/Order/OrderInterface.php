<?php

namespace App\Repositories\Order;

interface OrderInterface
{
    public function getPaginated() : object;
    public function getListPaginated(int $id);
    public function getById(int $id);
    public function store(array $orderDetails) : object;
    public function storeList(array $orderDetails) : object;
    public function update(int $id, array $newDetails) : bool;
}
