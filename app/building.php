<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ecg_items;
use App\select;

class building extends Model
{
    protected $table = 'buildings';
    protected $primaryKey = 'season';

    public function ecg_items()
    {
        return $this->belongsToMany(ecg_items::class, 'posses', 'building_season', 'ecg_items_id')->withPivot('quantity');
    }

    public function selects()
    {
        return $this->hasMany(select::class);
    }
}
