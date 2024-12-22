<?php

namespace App\View\Components\Portal\Dash\Header;

use App\AppPlugin\PortalCard\Models\PortalCard;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class CardList extends Component {

    public $active;
    public $cards;
    public $option_2;
    public $option_3;

    public function __construct(
        $active = null,
        $cards = array(),
        $option_2 = null,
        $option_3 = null,

    ) {

        $this->active = $active ?: config('appPortal.DashBord.headerCardList');

        if ($this->active) {
            $this->cards = PortalCard::query()
                ->where('user_id', Auth::guard('customer')->user()->id)
                ->with('template')
                ->take(5)->get();

        } else {
            $this->cards = $cards;
        }


        $this->option_2 = $option_2;
        $this->option_3 = $option_3;
    }

    public function render(): View|Closure|string {
        return view('components.portal.dash.header.card-list');
    }
}
