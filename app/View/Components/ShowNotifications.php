<?php

namespace App\View\Components;

use App\Models\Notification;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ShowNotifications extends Component
{
    public $notifications;

    public function __construct()
    {
        $this->notifications = Notification::where('is_read',0)->take(4)->get();
    }

    public function render(): View|string
    {
        return view('components.show-notifications', [
            'notifications' => $this->notifications
        ]);
    }
}
