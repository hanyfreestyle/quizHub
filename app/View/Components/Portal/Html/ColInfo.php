<?php

namespace App\View\Components\Portal\Html;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ColInfo extends Component {

    public $col;
    public $n;
    public $d;
    public $i;
    public $s;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $col = null,
        $n = null,
        $d = null,
        $i = null,
        $s = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->col = colRow($col);
        $this->n = $n;
        $this->d = $d;
        $this->i = $i;
        $this->s = $s;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.portal.html.col-info');
    }
}
