<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


use App\Models\Location;

class Car extends Model
{
    use HasFactory;
    use SoftDeletes;


    public function locations()
    {
        return $this->hasMany(Location::class)->orderBy('created_at', 'DESC');
    }

}
