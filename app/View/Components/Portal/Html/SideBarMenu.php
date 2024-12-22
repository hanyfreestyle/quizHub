<?php

namespace App\View\Components\Portal\Html;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBarMenu extends Component {

    public $t;
    public $pin;
    public $r;
    public $i;
    public $linkNav;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $t = null,
        $pin = false,
        $r = "#",
        $i = null,
        $linkNav = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->t = $t;
        $this->pin = $pin;
        $this->r = $r;
        $this->i = $i;
        $this->linkNav = $linkNav;
        if($this->r != '#'){
            $this->linkNav = " link-nav " ;
        }
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.portal.html.side-bar-menu');
    }
}
