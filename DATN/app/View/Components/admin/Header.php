<?php

namespace App\View\Components\admin;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    private $view;
    public function __construct()
    {
        $this->view = [];
    }
    public function render(): View|Closure|string
    {
        $this->view['user'] = auth()->user();
        return view('components.admin.header',$this->view);
    }
}
