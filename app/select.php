<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\building;
use App\ecg_items;
use App\records;
class select extends Model
{
    protected $fillable = ['user_id', 'ecg_items_id', 'building_season','is_sold'];
    public $incrementing = false;
    protected $table = 'select';
    protected $primaryKey = ['user_id', 'ecg_items_id', 'building_season','is_sold'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function building(){
        return $this->belongsTo(building::class);
    }
    public function ecg_item(){
        return $this->belongsTo(ecg_items::class);
    }

    public function records()
    {
        return $this->belongsToMany(records::class, 'calculated',[	'user_id', 'ecg_items_id', 'building_season'],[	'user_id', 'ecg_items_id', 'building_season']);
    }
}
