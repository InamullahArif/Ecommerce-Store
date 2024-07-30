<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Services\OrderService;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $orderService;

    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index(Request $request)
    {
        // dd($request->all());
        try {
            $orders = $this->orderService->getOrders($request,10);
            // dd($orders);
            if ($request->ajax()) {
                $total_order_view  = '';
                if ($orders->count() > 0) {
                    foreach ($orders as $order) {
                        $order_view = (string)view('dashboard.WebsiteManagement.Orders.single-order-row', compact('order'));
                        $total_order_view = $total_order_view . $order_view;
                    }
                } else {
                    $order_view = (string)view('dashboard.WebsiteManagement.Orders.single-order-row');
                    $total_order_view = $total_order_view . $order_view;
                }
                return response()->json([
                    'data' => $total_order_view,
                    'success' => true,
                ]);
            }
            return view('dashboard.WebsiteManagement.Orders.all-orders', compact('orders'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function show($id)
    {
        // dd($id);
        try {
            $orders = $this->orderService->getOrder($id);
            return view('dashboard.WebsiteManagement.Orders.view-order',compact('orders'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function destroy($id)
    {
        // dd($id);
        try {
            $order = $this->orderService->deleteOrder($id);
            return response()->json([
                'success'=>true,
                'message'=>'Order deleted successfully',
                'order'=>$order,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
