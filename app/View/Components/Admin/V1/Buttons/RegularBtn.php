<?php

namespace App\View\Components\Admin\V1\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RegularBtn extends Component
{
    /**
     * Create a new component instance.
     */
    public $btnType;
    public $type;
    public $title;


    public function __construct($btnType, $type, $title)
    {
        $this->btnType =  $btnType;
        $this->type = $type;
        $this->title = $title;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.buttons.regular-btn');
    }
}
