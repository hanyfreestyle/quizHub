<?php

namespace App\View\Components\Portal\Js\Pages;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalCode extends Component {

    public $print;
    public $id;
    public $option_1;
    public $option_2;
    public $option_3;


    public function __construct(
        $print, $id = null,
        $option_1 = null,
        $option_2 = null,
        $option_3 = null,

    ) {
        $this->print = $print;
        $this->id = $id;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;

    }

    public function render(): View|Closure|string {
        return view('components.portal.js.pages.modal-code');
    }
}
