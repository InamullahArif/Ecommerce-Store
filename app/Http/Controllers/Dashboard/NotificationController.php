<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;


use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Services\NotificationService;

class NotificationController extends Controller
{
    private $notificationService;

    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }
    public function markAsRead(Request $request)
    {
        // dd($id);
        $id = $request->id;
        try {
            $notifications = $this->notificationService->markAsRead($id);
            // dd($notifications);
            // if ($request->ajax()) {
                // $total_notification_view  = '';
                // if ($notifications->count() > 0) {
                //     foreach ($notifications as $notification) {
                //         $notification_view = (string)view('dashboard.Notifications.single-notification', compact('notification'));
                //         $total_notification_view = $total_notification_view . $notification_view;
                //     }
                // } else {
                //     $notification_view = (string)view('dashboard.Notifications.single-notification');
                //     $total_notification_view = $total_notification_view . $notification_view;
                // }
                // $paginationHtml = $users->paginate($perPage=10);
                return response()->json([
                    'data' => $notifications,
                    'success' => true,
                    // 'pagination' => $paginationHtml
                ]);
            // }
            // return view('dashboard.all-user', compact('users'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
        
    }
    public function viewAllNotifications(Request $request)
    {
        // dd($request->all());
        try {
            $notifications = $this->notificationService->viewAll($request,10);
            // dd($notifications);
            if ($request->ajax()) {
                $total_notification_view  = '';
                if ($notifications->count() > 0) {
                    foreach ($notifications as $notification) {
                        $notification_view = (string)view('dashboard.Notifications.single-notification', compact('notification'));
                        $total_notification_view = $total_notification_view . $notification_view;
                    }
                } else {
                    $notification_view = (string)view('dashboard.Notifications.single-notification');
                    $total_notification_view = $total_notification_view . $notification_view;
                }
                // $paginationHtml = $users->paginate($perPage=10);
                return response()->json([
                    'data' => $total_notification_view,
                    'success' => true,
                    // 'pagination' => $paginationHtml
                ]);
            }
            // dd($notifications);
            return view('dashboard.Notifications.all-notification', compact('notifications'));
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function deleteNotifications($id)
    {
        try {
            $notifications = $this->notificationService->deleteNotification($id);
            return response()->json([
                'success'=>true,
                'message'=>'Notification deleted successfully',
                'notification'=>$notifications,
            ]);
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }
    }
    public function getNotifications()
    {
       try {
       $notification_count=  Notification::where('is_read', 0)->count();
        // $notifications = Notification::where('is_read',0)->take(4)->get();
        return response()->json([
            'success'=>true,
            'message'=>'Notification sent successfully',
            'notification_count'=>$notification_count,
            // 'notifications'=>$notifications,
        ]);
    } catch (\Exception $exception) {
        return $exception->getMessage();
    }
    }
}
