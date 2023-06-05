<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LoginPageLite extends Component
{
    public $url;
    public $logo;
    public $pageTitle;
    public $baseUrl;

    public function __construct($url, $logo, $baseUrl, $pageTitle)
    {
        $this->url = $url;
        $this->logo = $logo;
        $this->baseUrl = $baseUrl;
        $this->pageTitle = $pageTitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('admin.v1.components.login-page-lite');
    }
}
