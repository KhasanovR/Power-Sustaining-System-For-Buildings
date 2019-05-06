<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\building;
use App\minmax;
use App\select;

class ecg_items extends Model
{
    protected $table = 'ecg_items';
 	protected $primaryKey = 'id';
    public function buildings()
    {
        return $this->belongsToMany(building::class,'posses', 'ecg_items_id','building_season')->withPivot('quantity');
    }

    public function minmax()
    {
    	return $this->belongsTo(minmax::class, 'item_type', 'item_type');
    }
    public function selects(){
        return $this->hasMany(select::class);
    }
}
