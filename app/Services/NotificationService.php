<?php

namespace App\Services;

use App\Models\Notification;
use Illuminate\Support\Facades\Hash;


class NotificationService
{           
    public function markAsRead($id)
    {
        $notification = Notification::findOrFail($id);
        if($notification)
        {
            $notification->is_read = true;
            $notification->save();
        }
        return $notification;
    }
    public function viewAll($request,$perPage = 10)
    {
        $notifications = Notification::ApplyFilter($request->only(['search_by_name']))->orderBy('created_at', 'desc')->paginate($perPage);
        return $notifications;
    }
    public function deleteNotification($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->delete();
        return $notification;
    }
}
