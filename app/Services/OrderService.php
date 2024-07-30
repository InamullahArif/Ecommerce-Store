<?php

namespace App\Services;

use App\Models\Order;

class OrderService
{
    public function getOrders($request, $perPage = 10)
    {
        $query = Order::ApplyFilter($request->only(['search_by_name']))->orderBy('created_at', 'desc');
        return $query->paginate($perPage)->withQueryString();
    }
    public function deleteOrder($id)
    {
        $order = Order::where('id', $id)->firstOrFail();
        if ($order) {
            $order->delete();
            return $order;
        }
    }
    public function getOrder($id)
    {
        $order = Order::where('id', $id)->first();
        if ($order) {
            return $order;
        }
    }
}
