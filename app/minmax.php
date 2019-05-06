<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ecg_items;
class minmax extends Model
{
	public $incrementing = false;
	protected $table = 'minmaxes';
 	protected $primaryKey = 'item_type';

    public function ecg_items()
    {
        return $this->hasMany(ecg_items::class, 'item_type', 'item_type');
    }

}
