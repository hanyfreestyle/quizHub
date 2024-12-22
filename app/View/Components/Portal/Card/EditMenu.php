<?php

namespace App\View\Components\Portal\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EditMenu extends Component {

    public $card;
    public $selRoute;
    public $option_1;
    public $option_2;
    public $option_3;


    public function __construct(
        $card = array(),
        $selRoute = null,
        $option_1 = null,
        $option_2 = null,
        $option_3 = null,

    ) {
        $this->card = $card;
        $this->selRoute = $selRoute;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;

    }

    public function render(): View|Closure|string {
        return view('components.portal.card.edit-menu');
    }
}
