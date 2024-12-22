<?php

namespace App\AppPlugin\PortalCard\Models;


use App\AppPlugin\UsersApp\Models\UsersApp;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;


class PortalCard extends Model {
    protected $table = "app_card";
    protected $primaryKey = 'id';
    protected $fillable = [''];

    public function card_data() {
        return $this->hasMany(PortalCardData::class, 'card_id')->orderBy('position')->with('input_info');
    }

    public function all_templates(): HasMany {
        return $this->hasMany(PortalCardTemplate::class, 'card_id', 'id');
    }

    public function template(): HasOne {
        return $this->hasOne(PortalCardTemplate::class, 'id', 'template_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(UsersApp::class,'user_id','id');
    }


}
