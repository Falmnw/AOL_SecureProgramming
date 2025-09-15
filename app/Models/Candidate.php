<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $fillable = ['organization_id','organization_name','candidate_name','vision','mission','photo'];

    public function belongsOrganization(){
        return $this->belongsTo(Organization::class);
    }
}
