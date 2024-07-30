<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Order;
use App\Models\Visitor;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function showOrdersGraph($request)
    {
        // Get the current date
        $now = Carbon::now();
    
        // Get the date one year ago from today
        $oneYearAgo = $now->subYear();
    
        // Get total number of orders in the last year
        $totalOrdersLastYear = Order::where('created_at', '>=', $oneYearAgo)->count();
        
        // Get the count of paid orders in the last year
        $paidOrders = Order::where('created_at', '>=', $oneYearAgo)
            ->where('status', 'paid')
            ->count();
        
        // Get the total sum of the total_price column for the orders in the last year
        $totalPriceSum = Order::where('created_at', '>=', $oneYearAgo)->sum('total_price');
        
        // Get the monthly orders count, sum of prices, and paid orders count for the last year
        $monthlyData = Order::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total_price) as monthly_sum'),
                DB::raw('SUM(CASE WHEN status = "paid" THEN 1 ELSE 0 END) as paid_count')
            )
            ->where('created_at', '>=', $oneYearAgo)
            ->groupBy(DB::raw('YEAR(created_at)'), DB::raw('MONTH(created_at)'))
            ->orderBy(DB::raw('YEAR(created_at)'), 'asc')
            ->orderBy(DB::raw('MONTH(created_at)'), 'asc')
            ->get();
    
        // Format the data into arrays
        $ordersData = array_fill(1, 12, 0); // Initialize array for order counts with 12 months set to 0
        $monthlyPrices = array_fill(1, 12, 0); // Initialize array for monthly price sums with 12 months set to 0
        $paidOrdersData = array_fill(1, 12, 0); // Initialize array for paid orders count with 12 months set to 0
    
        foreach ($monthlyData as $data) {
            $ordersData[$data->month] = $data->count;
            $monthlyPrices[$data->month] = $data->monthly_sum;
            $paidOrdersData[$data->month] = $data->paid_count; // Set the paid orders count for the month
        }

        // Get total visitors from the visitors table
        $totalVisitors = Visitor::count();

        // Get the number of visitors per month for the last 12 months
        $monthlyVisitorsData = Visitor::select(
                DB::raw('MONTH(visited_at) as month'),
                DB::raw('COUNT(*) as count')
            )
            ->where('visited_at', '>=', $oneYearAgo)
            ->groupBy(DB::raw('YEAR(visited_at)'), DB::raw('MONTH(visited_at)'))
            ->orderBy(DB::raw('YEAR(visited_at)'), 'asc')
            ->orderBy(DB::raw('MONTH(visited_at)'), 'asc')
            ->get();

        // Initialize array for monthly visitors counts with 12 months set to 0
        $monthlyVisitors = array_fill(1, 12, 0);

        foreach ($monthlyVisitorsData as $data) {
            $monthlyVisitors[$data->month] = $data->count;
        }

        return [
            'price' => $totalPriceSum,
            'total_orders_last_year' => $totalOrdersLastYear,
            'monthly_orders' => $ordersData,
            'monthly_prices' => $monthlyPrices,
            'paid_orders' => $paidOrders,
            'paid_orders_monthly' => $paidOrdersData, // Added line for paid orders count per month
            'total_visitors' => $totalVisitors,  // Added line for total visitors
            'monthly_visitors' => $monthlyVisitors, // Added line for monthly visitors count
        ];
    }
    public function showReportsGraph($request)
    {
        $orders = Order::all();
        $prices = [];
        $i=0;
        $sum = 0;
        $uniqueEmails = Order::select('email')
        ->groupBy('email')
        ->havingRaw('COUNT(email) = 1')
        ->pluck('email');
        // dd($uniqueEmails);
        foreach($orders as $data)
        {
            $prices[$i] = $data->total_price;
            $sum = $sum + $data->total_price;
            $i++;
        }
        // dd($prices);
        return [
            'prices' => $prices,
            'sum'=>$sum,
            'emails'=>$uniqueEmails,
        ];
    }
}
