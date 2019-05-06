<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\rank;
class level extends Model
{
	protected $table = 'levels';
 	protected $primaryKey = 'id';
 	protected $fillable=['rank_id'];
    public function rank()
    {
        return $this->belongsTo(rank::class);
    }
}
