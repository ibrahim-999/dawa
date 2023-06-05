<?php

namespace App\View\Components\Admin\V1\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EmailInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $size;
    public $name;
    public $title;
    public $placeholder;
    public $prepend;
    public $value;

    public function __construct($size, $name, $title, $placeholder, $prepend,$value)
    {
        $this->size = $size;
        $this->name = $name;
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->prepend = $prepend;
        $this->value = $value;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.form.email-input');
    }
}
