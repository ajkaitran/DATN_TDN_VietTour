<?php

namespace App\View\Components;

use App\Models\ProductCategory;
use App\Models\ProductCategoryType;
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
        $objTourCate = new ProductCategory();
        $objTourType = new ProductCategoryType();
        $this->view['listType'] = $objTourType->where('show_menu', 1)->where('active', 1)->take(3)->get();
        $this->view['categoriesByType'] = $objTourType->with(['categories' => function($query) {
            $query->where('active', 1);
        }])->get();
        // $this->view['listCateParent'] = $objTourCate->where('parent_id', null)->where('active', 1)->get();
        // $this->view['listCateChidrent'] = $objTourCate->where('parent_id', !null)->where('active', 1)->get();
        return view('components.header', $this->view);
    }
}
