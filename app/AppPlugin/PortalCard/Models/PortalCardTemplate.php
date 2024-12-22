<?php

namespace App\AppPlugin\PortalCard\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class PortalCardTemplate extends Model {
    protected $table = "app_card_template";
    protected $primaryKey = 'id';
    protected $fillable = [''];
    public $timestamps = false;


//    public function input_info(): BelongsTo {
//        return $this->belongsTo(PortalCardInput::class,'input_id','id');
//    }

}
