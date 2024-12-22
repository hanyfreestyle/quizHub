<?php

namespace App\View\Components\Portal\Html;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component {

    public $col;
    public $t;
    public $f;
    public $style;
    public $i;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $col = 'col-lg-12',
        $t = null,
        $f = null,
        $style = ' card shadow-none border ',
        $i = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->col = $col;
        $this->t = $t;
        $this->f = $f;
        $this->style = $style;
        $this->i = $i;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.portal.html.card');
    }
}
