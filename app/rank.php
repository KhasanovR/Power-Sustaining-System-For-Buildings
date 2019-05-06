<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\best_record;

class rank extends Model
{

    protected $fillable = ['rank_no'];
	protected $table = 'ranks';
 	protected $primaryKey = 'id';
	
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function level()
    {
        return $this->hasOne('App\level');
    }
    
    public function best_record()
    {
        return $this->hasOne(best_record::class);
    }
}
