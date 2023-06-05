<?php

namespace App\View\Components\Admin\V1\Buttons;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalBtn extends Component
{
    /**
     * Create a new component instance.
     */
    public $target;


    public function __construct($target)
    {
        $this->target = $target;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.buttons.modal-btn');
    }
}
