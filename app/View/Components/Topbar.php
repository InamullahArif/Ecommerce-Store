<?php

namespace App\View\Components;

use Closure;
use App\Models\Notification;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class topbar extends Component
{
    /**
     * Create a new component instance.
     */
    public $notifications;
    public $unreadNotificationsCount;
    public function __construct()
    {
        $this->notifications = Notification::where('is_read',0)->orderBy('created_at','desc')->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.topbar', [
            'notifications' => $this->notifications,
           
        ]);
    }
}
