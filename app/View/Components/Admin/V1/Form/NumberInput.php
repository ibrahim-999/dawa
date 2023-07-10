<?php

namespace App\View\Components\Admin\V1\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NumberInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $size;
    public $name;
    public $title;
    public $placeholder;
    public $step;
    public $min;
    public $max;
    public $value;
    public $errorName;

    public function __construct($errorName,$size, $name, $title, $placeholder, $step, $min, $max,$value)
    {
        $this->size = $size;
        $this->name = $name;
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->step = $step;
        $this->min = $min;
        $this->max = $max;
        $this->value = $value;
        $this->errorName = $errorName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.form.number-input');
    }
}
