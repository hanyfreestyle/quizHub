<?php

namespace App\View\Components\Admin\Product;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Filter extends Component {
    public $fromDate;
    public $row;
    public $defRoute;
    public $getSessionData;
    public $fiterDate;
    public $fiterPrice;

    public function __construct(
        $formName = 'ProductFilters',
        $row = array(),
        $defRoute = ".filter",
        $fiterDate = true,
        $fiterPrice = true,

    ) {
        $this->formName = $formName;
        $this->row = $row;
        $this->defRoute = $defRoute;
        $this->getSessionData = Session::get($this->formName);
        $this->fiterDate = $fiterDate;
        $this->fiterPrice = $fiterPrice;

    }

    public function render(): View|Closure|string {
        return view('components.admin.product.filter');
    }
}
