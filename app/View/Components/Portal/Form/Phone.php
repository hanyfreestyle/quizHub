<?php

namespace App\View\Components\Portal\Form;

use App\AppPlugin\Data\Country\Country;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\View\Component;

class Phone extends Component {

    public $row;
    public $col;
    public $lV;
    public $dir;
    public $id;
    public $label;
    public $req;
    public $name;
    public $inputclass;
    public $value;
    public $placeholder;
    public $initialCountry;
    public $style;
    public $holder;
    public $noLabel;

    public function __construct(
        $col = null,
        $lV = true,
        $dir = null,
        $id = null,
        $label = null,
        $req = true,
        $name = null,
        $inputclass = null,
        $value = null,
        $placeholder = false,
        $initialCountry = 'om',
        $style = null,
        $holder = false,
        $noLabel = null,
        $row = null,
    ) {

        $this->col = colRow($col);
        $this->dir = $dir;
        $this->id = $id;
        $this->label = $label;
        $this->req = $req;
        $this->name = $name;
        if ($this->id == null) {
            $this->id = $this->name;
        }
        $this->inputclass = $inputclass;
        $this->initialCountry = $initialCountry;
        $this->style = $style;

        if ($row != null) {
            $printName = $this->name;
            $this->value = old($printName, $row->$printName);
        } else {
            $this->value = $value;
        }

        if ($holder == true) {
            $this->placeholder = true;
            $this->lV = false;
            $this->noLabel = "no_label";
        } else {
            $this->placeholder = $placeholder;
            $this->lV = $lV;
            $this->noLabel = "";
        }

    }

    public function render(): View|Closure|string {
        $onlyCountries = Cache::remember('CashOnlyCountries', cashDay(7), function () {
            return Country::where('is_active', true)->pluck('iso2')->toArray();
        });

        $onlyCountriesList = "";
        foreach ($onlyCountries as $country) {
            $onlyCountriesList .= "'";
            $onlyCountriesList .= strtolower($country);
            $onlyCountriesList .= "',";
        }
        return view('components.portal.form.phone', compact('onlyCountriesList'));
    }
}
