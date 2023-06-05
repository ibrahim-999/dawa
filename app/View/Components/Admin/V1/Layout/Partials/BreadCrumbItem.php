<?php

namespace App\View\Components\Admin\V1\Layout\Partials;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BreadCrumbItem extends Component
{
    public $isActive;
    public $url;
    public $title;
    public function __construct($isActive,$url,$title)
    {
        $this->isActive=$isActive;
        $this->url=$url;
        $this->title=$title;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.layout.partials.breadcrumb-item');
    }
}
