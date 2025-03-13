<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PointsModel extends Model
{
    protected $table = 'points';

    protected$guided = 'id';

    protected $fillable = [
        'geom',
        'name',
        'description',
        'image',
    ];
}
