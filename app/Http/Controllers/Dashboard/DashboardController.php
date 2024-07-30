<?php
namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\DashboardService;
class DashboardController extends Controller
{
    private $dashboardService;

    public function __construct(DashboardService $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }
    public function index(Request $request)
    {

        try {
            $orders = $this->dashboardService->showOrdersGraph($request);
            // dd($orders);
            return view('dashboard.index',compact('orders'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function reports(Request $request)
    {

        try {
            $orders = $this->dashboardService->showReportsGraph($request);
            // dd($orders);
            return view('dashboard.report',compact('orders'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
