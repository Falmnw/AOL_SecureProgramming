<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class buat_sesi extends Model
{
    protected $table = 'buat_sesi';
    protected $fillable = ['organization_id','title', 'start_time', 'end_time'];
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

}
