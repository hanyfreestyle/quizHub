<?php

namespace App\View\Components\Portal\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Button extends Component {

    public $type;
    public $n;
    public $i;
    public $bg;
    public $id;
    public $back;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $type = 'submit',
        $n = null,
        $i = null,
        $bg = "p",
        $id = null,
        $back = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->type = $type;
        $this->i = $i;
        $this->bg = getBgColor($bg);

        if ($n == 'update') {
            $this->n = __('portal/dash.but_update');
            $this->i = 'fa-solid fa-rotate';
        } elseif ($n == 'crop'){
            $this->n = __('portal/dash.but_save');
            $this->i = 'fa-solid fa-floppy-disk';
        } elseif ($n == 'reload'){
            $this->n = __('portal/dash.but_reload');
            $this->i = 'fas fa-sync';

        } elseif ($n == 'edit'){
            $this->n = __('portal/dash.but_edit');
            $this->i = 'fas fa-edit';
        }else{
            $this->n = __('portal/dash.but_add');
            $this->i = 'fas fa-plus';
        }



        $this->id = $id;
        $this->back = $back;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.portal.form.button');
    }
}
