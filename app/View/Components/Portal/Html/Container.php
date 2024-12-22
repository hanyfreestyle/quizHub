<?php

namespace App\View\Components\Portal\Html;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Container extends Component {

    public $oneDiv;
    public $style;
    public $option_1;
    public $option_2;


    public function __construct(
        $oneDiv = true,
        $style = 'container-fluid ',
        $option_1 = null,
        $option_2 = null,

    ) {
        $this->oneDiv = $oneDiv;
        $this->style = $style;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;

    }

    public function render(): View|Closure|string {
        return view('components.portal.html.container');
    }
}
