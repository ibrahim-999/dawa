<?php

namespace App\View\Components\Admin\V1\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadiobtnGroup extends Component
{
    /**
     * Create a new component instance.
     */
    public $groupName;
    public $ribbonColorText;


    public function __construct($groupName,$ribbonColorText)
    {
        $this->groupName = $groupName;
        $this->ribbonColorText = $ribbonColorText;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.form.radiobtn-group');
    }
}
