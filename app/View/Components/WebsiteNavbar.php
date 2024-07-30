<?php

namespace App\View\Components;

use Closure;
use App\Models\Navbar;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class WebsiteNavbar extends Component
{
    /**
     * Create a new component instance.
     */
    public $navbar;
    public $image;
    public function __construct()
    {
        $this->navbar = Navbar::with('image')->first();
        $this->image = $this->navbar->image;
        $this->navbar = $this->navbar->data;
        $this->navbar = json_decode($this->navbar);
        // dd($this->image);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.website-navbar', [
            'data' => $this->navbar,
            'image' => $this->image,
        ]);
    }
}
