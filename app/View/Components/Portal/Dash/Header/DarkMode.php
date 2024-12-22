<?php

namespace App\View\Components\Portal\Dash\Header;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DarkMode extends Component {

    public $active;
    public $option_1;
    public $option_2;
    public $option_3;

    public function __construct(
        $active = null,
        $option_1 = null,
        $option_2 = null,
        $option_3 = null,

    ) {
        if ($active) {
            $this->active = $active;
        } else {
            $this->active = config('appPortal.DashBord.headerDarkMode');
        }
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
    }

    public function render(): View|Closure|string {
        return view('components.portal.dash.header.dark-mode');
    }
}
