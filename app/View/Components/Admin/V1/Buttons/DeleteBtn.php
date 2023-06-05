<?php

namespace App\View\Components\Admin\V1\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteBtn extends Component
{
    /**
     * Create a new component instance.
     */
    public $btnType;
    public $url;


    public function __construct($btnType, $url)
    {
        $this->btnType = $btnType;
        $this->url = $url;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.buttons.delete-btn');
    }
}
