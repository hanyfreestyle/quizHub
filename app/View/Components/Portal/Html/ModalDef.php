<?php

namespace App\View\Components\Portal\Html;

use App\AppPlugin\PortalCard\Models\PortalCardInput;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalDef extends Component {

    public $id;
    public $s;
    public $modalStyle;
    public $modal;
    public $static;
    public $centered;
    public $cardId;
    public $inputData;
    public $option_5;
    public $option_6;
    public $option_7;


    public function __construct(
        $id = null,
        $s = "s",
        $static = false,
        $centered = true,
        $cardId = 'hhh',
        $inputData = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->id = $id;
        $this->s = $s;
        if ($this->s == 'full') {
            $this->modalStyle = "bd-example-modal-fullscreen";
            $this->modal = "modal-fullscreen";
        } elseif ($this->s == 's') {
            $this->modalStyle = "bd-example-modal-sm";
            $this->modal = "modal-sm";
        } elseif ($this->s == 'l') {
            $this->modalStyle = "bd-example-modal-lg";
            $this->modal = "modal-lg";
        } elseif ($this->s == 'xl') {
            $this->modalStyle = "bd-example-modal-xl";
            $this->modal = "modal-xl";
        }
        if ($static) {
            $this->static = ' data-bs-backdrop="static" data-bs-keyboard="false" ';
        } else {
            $this->static = null;
        }
        if ($centered) {
            $this->centered = ' modal-dialog-centered ';
        } else {
            $this->centered = null;
        }

        $this->cardId = $cardId;

        if (intval($cardId)) {

            $this->inputData = PortalCardInput::query()->where('id', $cardId)->first();
        } else {
            $this->inputData = $inputData;
        }



        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.portal.html.modal-def');
    }
}
