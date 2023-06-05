<?php

namespace App\View\Components\Admin\V1\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $size;
    public $name;
    public $title;
    public $multiple;

    public function __construct($size, $name, $title,$multiple)
    {
        $this->size = $size;
        $this->name = $name;
        $this->title = $title;
        $this->multiple = $multiple;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.form.select-input');
    }
}
