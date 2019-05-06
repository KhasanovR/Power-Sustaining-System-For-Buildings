<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\best_record;

class records extends Model
{
    protected $table = 'records';
    // protected $primaryKey = ['id','user_id'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function best_record()
    {
        return $this->hasOne(best_record::class, 'id');
    }
}