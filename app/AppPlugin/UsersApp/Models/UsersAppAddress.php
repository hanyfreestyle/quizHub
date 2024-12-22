<?php

namespace App\AppPlugin\UsersApp\Models;

use App\AppPlugin\Data\City\Models\City;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsersAppAddress extends Model {
    use SoftDeletes;

    protected $table = "users_app_addresses";
    protected $primaryKey = 'id';
    protected $fillable = [];


    public function city(): BelongsTo {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function user(): BelongsTo {
        return $this->belongsTo(UsersApp::class, 'user_id');
    }

}
