<?php

namespace App\View\Components\Portal\Dynamic;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HtmlText extends Component {

    public $row;
    public $fieldName;
    public $fieldText;
    public $fieldValue;
    public $noData;
    public $option_5;

    public function __construct(
        $fieldName,
        $row = array(),
        $fieldText = null,
        $fieldValue = null,
        $noData = null,
        $option_5 = null,

    ) {
        $this->row = $row;
        $this->fieldName = $fieldName;
        $this->noData = $noData;

        if ($row->$fieldName) {
            $this->fieldValue = $row->$fieldName;
            $this->fieldText = $row->$fieldName;
        } else {
            $this->fieldValue = null;
            $this->fieldText = $noData;
        }

        $this->option_5 = $option_5;

    }

    public function render(): View|Closure|string {
        return view('components.portal.dynamic.html-text');
    }
}
