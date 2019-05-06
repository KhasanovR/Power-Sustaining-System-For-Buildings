<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class best_record extends Model
{
	public $incrementing = false;
	protected $table = 'best_records';
    // protected $fillable = ['user_id'];
 	// protected $primaryKey = ['rec_id','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function record()
    {
        return $this->belongsTo('App\records', 'rec_id');
    }
}
