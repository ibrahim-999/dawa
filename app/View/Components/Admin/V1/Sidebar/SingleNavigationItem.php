<?php

namespace App\View\Components\Admin\V1\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SingleNavigationItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $reference;
    public $badge;
    public $title;

    public function __construct($reference, $badge, $title)
    {
        $this->reference = $reference;

        $this->badge = $badge;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.sidebar.single-navigation-item');
    }
}
