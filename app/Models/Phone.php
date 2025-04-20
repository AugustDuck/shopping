<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phone extends Model
{
    /** @use HasFactory<\Database\Factories\PhoneFactory> */
    use HasFactory,SoftDeletes;

    protected $fillable = ['phone_number', 'user_id'];
    
    public function user()
    {
    
        return $this->belongsTo(User::class);
    }
}
