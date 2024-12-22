<?php

namespace App\View\Components\Portal\CardTemplate;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ViewCard extends Component {

    public $viewType;
    public $template;
    public $card;
    public $option_2;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $viewType = 'list',
        $template = true,
        $card = null,
        $option_2 = null,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {
        $this->viewType = $viewType;
        $this->template = $template;
        $this->card = $card;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.portal.card-template.view-card');
    }
}
