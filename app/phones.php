<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
class phones extends Model
{
	public $incrementing = false;
    protected $table = 'phones';
 	protected $primaryKey = ['user_id', 'phone'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
