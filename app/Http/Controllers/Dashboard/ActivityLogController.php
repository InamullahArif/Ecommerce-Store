<?php

// namespace App\Http\Controllers;
namespace App\Http\Controllers\Dashboard;

use App\Models\ActivityLog;

use App\Helpers\LogActivity;
use App\Services\LogService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivityLogController extends Controller
{
    private $logService;
    public function __construct(LogService $logService)
    {
        $this->logService = $logService;
    }
    public function addLog($subject,$request)
    {
        try {
            $this->logService->addLogs($subject,$request);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function logActivity(Request $request)
    {
		// dd($request->all());
        try {
            $logs =  $this->logService->getLogs($request);
            if ($request->ajax()) {
                $total_log_view  = '';
                if ($logs->count() > 0) {
                    $i=0;
                    foreach ($logs as $log) {
                        $i++;
                        $log_view = (string)view('dashboard.ActivityLogs.single-log-row', compact('log','i'));
                        $total_log_view = $total_log_view . $log_view;
                    }
                } else {
                    $log_view = (string)view('dashboard.ActivityLogs.single-log-row');
                    $total_log_view = $total_log_view . $log_view;
                }
                // $paginationHtml = $logs->paginate($perPage=10);
                return response()->json([
                    'data' => $total_log_view,
                    'success' => true,
                    // 'pagination' => $paginationHtml
                ]);
            }
            return view('dashboard.ActivityLogs.all-logs',compact('logs'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function viewLog($id)
    {
        try {
            $logs =  $this->logService->getSingleLog($id);        
            return view('dashboard.ActivityLogs.view-log',compact('logs'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function delLog($id)
    {
        // dd($id);
        try {
            $logs =  $this->logService->deleteLog($id);        
            return response()->json([
                'success'=>true,
                'message'=>'Log deleted successfully',
                'log'=>$logs,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
}
