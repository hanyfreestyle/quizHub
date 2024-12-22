<?php

namespace App\AppPlugin\PortalCard\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PortalCardInput extends Model implements TranslatableContract {
    use Translatable;

    public $translatedAttributes = ['suggestion', 'name'];
    protected $fillable = [''];
    protected $table = "app_card_input";
    protected $primaryKey = 'id';
    protected $translationForeignKey = 'input_id';
    public $timestamps = false;


    public function suggestion_list(): HasMany {
        return $this->hasMany(PortalCardInputTranslation::class, 'input_id', 'id')
            ->where('name', null);
    }

    public function cardData() {
        return $this->hasMany(PortalCardData::class, 'input_id');
    }

}
