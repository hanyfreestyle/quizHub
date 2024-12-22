<?php

namespace App\View\Components\Portal\Js;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cropper extends Component {

    public $aspectRatio;
    public $route;
    public $back;
    public $imageType;
    public $rang;
    public $minWidth;
    public $maxWidth;
    public $minHeight;
    public $maxHeight;
    public $prefix;


    public function __construct(
        $route, $back, $aspectRatio, $imageType, $rang,
        $minWidth = null,
        $maxWidth = null,
        $minHeight = null,
        $maxHeight = null,
        $prefix = null,

    ) {

        $this->prefix = $prefix;
        $this->aspectRatio = $aspectRatio;
        $this->route = $route;
        $this->back = $back;
        $this->imageType = $imageType;
        $this->rang = explode('|', $rang);
        $this->minWidth = $minWidth ?? $this->rang[0];
        $this->minHeight = $minHeight ?? $this->rang[0];
        $this->maxWidth = $maxWidth ?? $this->rang[1];
        $this->maxHeight = $maxHeight ?? $this->rang[1];


    }

    public function render(): View|Closure|string {
        return view('components.portal.js.cropper');
    }
}
