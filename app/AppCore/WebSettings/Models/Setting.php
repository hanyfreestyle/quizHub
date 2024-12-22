<?php

namespace App\AppCore\WebSettings\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Setting extends Model implements TranslatableContract {

    use Translatable;


    protected $casts = [
        'telegram_key' => 'encrypted',
        'telegram_phone' => 'encrypted',
        'telegram_group' => 'encrypted',
    ];



    public $translatedAttributes = ['name', 'g_title', 'g_des', 'closed_mass', 'meta_des', 'whatsapp_des', 'schema_address', 'schema_city'];
    protected $fillable = ['facebook', 'twitter', 'youtube', 'instagram', 'google_api', 'web_status', 'phone_num', 'whatsapp_num', 'telegram_group'];
    protected $table = "config_setting";
    protected $primaryKey = 'id';
    public $timestamps = false;


}
