<?php

namespace App\View\Components;

use Closure;
use App\Models\Navbar;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class WebsiteFooter extends Component
{
    /**
     * Create a new component instance.
     */
    public $footer;
    public $image;
    public function __construct()
    {
        $this->footer = Navbar::with('image')->first();
        $this->image = $this->footer->image;
        $this->footer = $this->footer->data;
        $this->footer = json_decode($this->footer);
        // dd($this->image);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website-footer', [
            'data' => $this->footer,
            'image' => $this->image,
        ]);
    }
}
