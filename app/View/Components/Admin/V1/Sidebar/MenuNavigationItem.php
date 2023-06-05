<?php

namespace App\View\Components\Admin\V1\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuNavigationItem extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $badge;
    public $name;

    public function __construct($title, $badge, $name)
    {
        $this->title = $title;
        $this->name = $name;
        $this->badge = $badge;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.sidebar.menu-navigation-item');
    }
}
