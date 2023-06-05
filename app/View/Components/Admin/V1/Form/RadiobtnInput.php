<?php

namespace App\View\Components\Admin\V1\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class RadiobtnInput extends Component
{
    /**
     * Create a new component instance.
     */
    public $name;
    public $title;
    public $checked;
    public $value;

    public function __construct($name, $title, $checked,$value)
    {
        $this->name = $name;
        $this->title = $title;
        $this->checked = $checked;
        $this->value = $value;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.form.radiobtn-input');
    }
}
