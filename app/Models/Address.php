<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Address extends Model
{
    
    use SoftDeletes;

    protected $fillable = [
        'address',
        'user_id'
    ];
    public function user()  {
        return $this->belongsTo(User::class);
    }
}
