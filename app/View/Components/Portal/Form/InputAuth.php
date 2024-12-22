<?php

namespace App\View\Components\Portal\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputAuth extends Component {

    public $row;
    public $name;
    public $l;
    public $type;
    public $id;
    public $i;
    public $holder;
    public $lV;
    public $v;

    public function __construct(
        $row = array(),
        $name = "name",
        $l = null,
        $type = 'text',
        $id = null,
        $i = null,
        $holder = true,
        $lV = false,
        $v = null,
    ) {
        $this->row = $row;
        $this->name = $name;
        $this->l = $l;
        $this->type = $type;

        if ($id) {
            $this->id = $id;
        } else {
            $this->id = $name;
        }

        $this->i = $i;

        if ($holder) {
            $this->holder = 'placeholder="' . $this->l . '"';
        } else {
            $this->holder = null;
        }

        $this->lV = $lV;
        $this->$v = $v;
    }

    public function render(): View|Closure|string {
        return view('components.portal.form.input-auth');
    }
}
