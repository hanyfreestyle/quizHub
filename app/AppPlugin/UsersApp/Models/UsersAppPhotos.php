<?php

namespace App\AppPlugin\UsersApp\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class UsersAppPhotos extends Model {


    protected $table = "users_app_photos";
    protected $primaryKey = 'id';
    protected $fillable = [];
    public $timestamps = false;


    public function user(): BelongsTo {
        return $this->belongsTo(UsersApp::class, 'user_id');
    }

}
