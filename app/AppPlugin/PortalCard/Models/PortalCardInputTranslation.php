<?php

namespace App\AppPlugin\PortalCard\Models;

use Illuminate\Database\Eloquent\Model;

class PortalCardInputTranslation extends Model {

    protected $table = "app_card_input_lang";
    protected $fillable = ['suggestion','input_id','locale'];
    public $timestamps = false;

}
