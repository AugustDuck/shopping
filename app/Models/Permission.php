<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Traits\HasRoles;

class Permission extends Model
{
    //
    use HasFactory,HasRoles;
    public $timestamps = false;
}
