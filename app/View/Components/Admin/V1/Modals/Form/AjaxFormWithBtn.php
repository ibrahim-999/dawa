<?php

namespace App\View\Components\Admin\V1\Modals\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AjaxFormWithBtn extends Component
{
    /**
     * Create a new component instance.
     */
    public $id;
    public $header;
    public $classes;
    public $method;
    public $fileable;
    public $url;

    public function __construct($id,$header,$classes,$url,$method,$fileable)
    {

        $this->id = $id;
        $this->classes = $classes;
        $this->header = $header;
        $this->url = $url;
        $this->method = $method;
        $this->fileable = $fileable;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.modals.form.ajax-form-with-btn');
    }
}
