<?php

namespace App\View\Components\Portal\Test;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Icon extends Component {

    public $icons;
    public $isactive;
    public $option_1;
    public $option_2;
    public $option_3;
    public $option_4;
    public $option_5;
    public $option_6;
    public $option_7;

    public function __construct(
        $icons = array(),
        $isactive = true,
        $option_1 = null,
        $option_2 = null,
        $option_3 = null,
        $option_4 = null,
        $option_5 = null,
        $option_6 = null,
        $option_7 = null,
    ) {

        $jsonPath = public_path('assets/portal/svg/icons_list.json');
        $jsonContent = file_get_contents($jsonPath);
        $icons = json_decode($jsonContent, true);


        // تحويل محتوى JSON إلى مصفوفة PHP
        $icons = json_decode($jsonContent, true);

        $this->icons = $icons;
        $this->isactive = $isactive;
        $this->option_1 = $option_1;
        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
        $this->option_4 = $option_4;
        $this->option_5 = $option_5;
        $this->option_6 = $option_6;
        $this->option_7 = $option_7;
    }

    public function render(): View|Closure|string {
        return view('components.portal.test.icon');
    }
}
