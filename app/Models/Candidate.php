<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['user_id', 'organization_id'];
    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
