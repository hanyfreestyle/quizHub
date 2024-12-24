<?php

namespace App\View\Components\AppPlugin\Quiz;

use App\AppPlugin\Data\Area\Models\Area;
use App\AppPlugin\Data\City\Models\City;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class FilterForm extends Component {

    public $row;
    public $config;
    public $formName;
    public $getSessionData;
    public $cityId;
    public $cityList;
    public $areaList;
    public $reportView;

    public function __construct(
        $row = array(),
        $config = array(),
        $formName = null,
        $cityList = array(),
        $areaList = array(),
        $reportView = false,

    ) {
        $this->row = $row;
        $this->config = $config;
        $this->formName = $formName;
        $this->reportView = $reportView;
        $this->getSessionData = Session::get($this->formName);


    }

    public function render(): View|Closure|string {
        return view('components.app-plugin.quiz.filter-form');
    }
}
