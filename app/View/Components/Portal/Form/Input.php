<?php

namespace App\View\Components\Portal\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component {

    public $inputType;
    public $row;
    public $name;
    public $l;
    public $lt;
    public $type;
    public $id;
    public $i;
    public $withIcon;
    public $holder;
    public $info;
    public $lV;
    public $v;
    public $req;
    public $reqType;
    public $col;
    public $selArr;
    public $dir;
    public $addStyle;

    public function __construct(
        $inputType = 'input',
        $row = array(),
        $name = "name",
        $l = null,
        $lt = null,
        $type = 'text',
        $id = null,
        $i = null,
        $withIcon = null,
        $holder = false,
        $info = null,
        $lV = true,
        $v = null,
        $req = true,
        $reqType = null,
        $col = null,
        $selArr = array(),
        $dir = null,
        $addStyle = null,
    ) {
        $this->inputType = $inputType;
        $this->col = colRow($col);
        $this->row = $row;
        $this->name = $name;
        $this->l = $lt ? __($lt) : $l;
        $this->info = $info == 1 ? __($lt . '_p') : $info;

        $this->type = $type;
        $this->req = $req;
        $this->reqType = formValidation($this->req, $reqType);
        $this->i = $i;
        $this->id = $id ?: $name;
        $this->withIcon = $i ? ' withIcon' : '';
        $this->lV = $lV;

        $this->holder = $holder ? 'placeholder="' . $this->l . '"' : null;
        $this->dir = $dir ? ' input_dir_'.$dir : null;
        $this->addStyle = $addStyle;


        $this->v = $row->$name ?? $v;

        $this->selArr = $selArr;

    }

    public function render(): View|Closure|string {
        return view('components.portal.form.input');
    }
}
