<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Sidebar extends Component
{
    private $view;
    public function __construct()
    {
        $this->view = [];
    }
    public function render(): View|Closure|string
    {
        return view('components.admin.sidebar', $this->view);
    }
}
