<?php

namespace App\View\Components\AppPlugin\UsersApp;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProfileMenu extends Component {

    public $row;
    public $pageView;
    public $option_1;
    public $option_2;


    public function __construct(
        $row = array(),
        $pageView = true,
        $option_1 = null,
        $option_2 = null,

    ) {
        $this->row = $row;
        $this->pageView = $pageView;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;

    }


    public function render(): View|Closure|string {
        return view('components.app-plugin.users-app.profile-menu');
    }
}
