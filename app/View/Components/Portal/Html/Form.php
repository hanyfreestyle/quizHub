<?php

namespace App\View\Components\Portal\Html;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Form extends Component {

    public $route;
    public $method;
    public $style;
    public $req;
    public $err;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $route = '#',
        $method = "post",
        $style = '   needs-validation custom-input customForm', #row g-3
        $req = true,
        $err = true,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->route = $route;
        $this->method = $method;
        $this->style = $style;
        if($req){
            $this->req = ' novalidate="" data-parsley-validate="" ';
        }else{
            $this->req = null;
        }

        $this->err = $err;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.portal.html.form');
    }
}
