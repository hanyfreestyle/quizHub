<?php

namespace App\View\Components\Portal\CardTemplate;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ViewPhoto extends Component {

    public $templateList;
    public $template;
    public $card;
    public $templatePhotos;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $templateList = array(),
        $template =  array(),
        $card =  array(),
        $templatePhotos = array(),
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->card = $card;
        $this->template = $template;
        $this->templateList = $templateList;
        $layout_id = $template->layout_id ;
        $templatePhotos = $this->templateList->where('id',$layout_id)->first()->photos ?? [];
        $this->templatePhotos = $templatePhotos;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.portal.card-template.view-photo');
    }
}
