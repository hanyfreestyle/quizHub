<?php

namespace App\View\Components\Portal\Html;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FormMassage extends Component {

    public $fullErr;
    public $isactive;
    public $addFormError;


    public function __construct(
        $fullErr = false,
        $isactive = true,
        $addFormError = true,

    ) {
        $this->fullErr = $fullErr;
        $this->isactive = $isactive;
        $this->addFormError = $addFormError;

    }

    public function render(): View|Closure|string {
        return view('components.portal.html.form-massage');
    }
}
