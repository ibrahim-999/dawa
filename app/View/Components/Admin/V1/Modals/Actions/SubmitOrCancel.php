<?php

namespace App\View\Components\Admin\V1\Modals\Actions;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SubmitOrCancel extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $header;
    public $classes;

    public function __construct($id,$header,$classes)
    {

        $this->id = $id;
        $this->classes = $classes;
        $this->header = $header;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.modals.actions.submit-or-cancel');
    }
}
