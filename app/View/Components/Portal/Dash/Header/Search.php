<?php

namespace App\View\Components\Portal\Dash\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Search extends Component {

    public $type;
    public $active;
    public $option_1;
    public $option_2;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(

        $type = "D",
        $active = null,
        $option_1 = null,
        $option_2 = null,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {

        $this->type = $type;
        if($active){
            $this->active = $active;
        }else{
            $this->active = config('appPortal.DashBord.headerSearch');
        }

        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.portal.dash.header.search');
    }
}