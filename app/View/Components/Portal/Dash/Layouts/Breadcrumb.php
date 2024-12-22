<?php

namespace App\View\Components\Portal\Dash\Layouts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Breadcrumb extends Component {

    public $page;
    public $isactive;
    public $option_1;
    public $option_2;
    public $option_3;


    public function __construct(
        $page = array(),
        $isactive = true,
        $option_1 = null,
        $option_2 = null,
        $option_3 = null,

    ) {
        $this->page = $page;
        $this->isactive = $isactive;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;

    }

    public function render(): View|Closure|string {
        return view('components.portal.dash.layouts.breadcrumb');
    }
}
