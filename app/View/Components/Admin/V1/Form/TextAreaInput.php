<?php

namespace App\View\Components\Admin\V1\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextAreaInput extends Component
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
    public $rows;
    public $length;

    public function __construct($size, $name, $title, $placeholder, $prepend,$value,$rows,$length)
    {
        $this->size = $size;
        $this->name = $name;
        $this->title = $title;
        $this->placeholder = $placeholder;
        $this->prepend = $prepend;
        $this->value = $value;
        $this->rows = $rows;
        $this->length = $length;


    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.form.text-area-input');
    }
}
