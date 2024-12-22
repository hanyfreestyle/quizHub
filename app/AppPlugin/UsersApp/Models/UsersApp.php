<?php

namespace App\AppPlugin\UsersApp\Models;

use App\AppPlugin\Data\City\Models\City;
use App\AppPlugin\PortalCard\Models\PortalCard;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UsersApp extends Authenticatable implements TranslatableContract{
    use Translatable;
    use HasApiTokens, Notifiable;
    use SoftDeletes;

    protected $guarded = "customer";

    protected $table = "users_app";
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'email', 'password',];
    protected $hidden = ['password', 'remember_token',];
    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    public $translatedAttributes = ['name_1','name_2','job_title','des'];
    protected $translationForeignKey = 'user_id';


    public function photos() {
        return $this->hasMany(UsersAppPhotos::class, 'user_id');
    }
    public function cards() {
        return $this->hasMany(PortalCard::class, 'user_id');
    }

    public function addresses(): HasMany {
        return $this->hasMany(UsersAppAddress::class, 'user_id')->orderBy('is_default', 'desc');
    }

    public function scopeDef(Builder $query): Builder {
        return $query->where('status', 1)->where('is_active', 1);
    }

    public function scopeDefAdmin(Builder $query): Builder {
        return $query->where('id', '!=', 0)->with('city');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| # orderDate
    public function registerDate(): string {
        return Carbon::parse($this->created_at)->locale(app()->getLocale())->translatedFormat('Y-m-d');
    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#|||||||||||||||||||||||||||||||||||||| #     city
    public function city(): BelongsTo {
        return $this->belongsTo(City::class, 'city_id', 'id')->with('translation');
    }

}
