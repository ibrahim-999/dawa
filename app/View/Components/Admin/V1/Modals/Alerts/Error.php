<?php

namespace App\View\Components\Admin\V1\Modals\Alerts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Error extends Component
{
    /**
     * Create a new component instance.
     */
    public $title;
    public $btnTitle;

    public function __construct($title,$btnTitle)
    {

        $this->title = $title;
        $this->btnTitle = $btnTitle;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.modals.alerts.error');
    }
}
