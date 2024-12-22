<?php

namespace App\View\Components\Portal\Card\Template;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Temp3 extends Component {

    public $card;
    public $isactive;
    public $option_1;
    public $option_2;

    public function __construct(
        $card = array(),
        $isactive = true,
        $option_1 = null,
        $option_2 = null,
    ) {
        $this->card = $card;
        $this->isactive = $isactive;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;

    }

    public function render(): View|Closure|string {
        return view('components.portal.card.template.temp3');
    }
}
