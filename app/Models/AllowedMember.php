<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllowedMember extends Model
{
    protected $fillable = ['email', 'organization_id'];
    public function organization() {
        return $this->belongsTo(Organization::class);
    }

}
