<?php

namespace App\View\Components\Admin\V1\Layout\Partials;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TopBar extends Component
{
    /**
     * Create a new component instance.
     */
    public $userName;
    public function __construct($userName)
    {
        $this->userName=$userName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.layout.partials.top-bar');
    }
}
