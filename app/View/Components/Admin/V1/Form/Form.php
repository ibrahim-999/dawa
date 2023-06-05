<?php

namespace App\View\Components\Admin\V1\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component
{
    public $url;
    public $description;
    public $title;
    public $method;
    public $fileable;

    public function __construct($url, $description, $title, $method, $fileable)
    {
        $this->url = $url;
        $this->description = $description;
        $this->title = $title;
        $this->method = $method;
        $this->fileable = $fileable;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.form.form');
    }
}
