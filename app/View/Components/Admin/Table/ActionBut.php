<?php

namespace App\View\Components\Admin\Table;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionBut extends Component {

    public $row;
    public $type;
    public $po;
    public $modelid;
    public $res;
    public $viewBut;
    public $can;
    public $l;

    public function __construct(
        $row = array(),
        $type = null,
        $po = 'button',
        $modelid = null,
        $res = 'd',
        $viewBut = true,
        $can = null,
        $l = null,


    ) {
        $this->l = $l;
        $this->can = $can;
        $this->row = $row;
        $this->type = $type;
        $this->po = $po;
        $this->modelid = $modelid;
        $this->res = getResponsiveType($res);
        $this->viewBut = $viewBut;

    }

    public function render(): View|Closure|string {
        return view('components.admin.table.action-but');
    }
}
