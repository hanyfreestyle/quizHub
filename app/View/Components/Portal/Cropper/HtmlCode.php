<?php

namespace App\View\Components\Portal\Cropper;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HtmlCode extends Component {

    public $prefix;
    public $t;
    public $p;
    public $style;
    public $row;
    public $imageType;
    public $route;
    public $option_6;
    public $option_7;

    public function __construct(
        $prefix = null,
        $t = null,
        $p = null,
        $style = ' cropperHtmlCard ',
        $row = array(),
        $imageType = null,
        $route = 'self',
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->prefix = $prefix;
        $this->t = $t;
        $this->p = $p;
        $this->style = $style;
        $this->row = $row;
        $this->imageType = $imageType;
        $this->route = $route;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.portal.cropper.html-code');
    }
}
