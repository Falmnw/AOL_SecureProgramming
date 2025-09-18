<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'member'];
    public function users()
    {
        return $this->belongsToMany(User::class, 'organization_users')
                    ->using(OrganizationUser::class)
                    ->withPivot('role_id')
                    ->withTimestamps();
    }

    public function candidates()
    {
        return $this->hasMany(Candidate::class);
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function allowedMembers() {
        return $this->hasMany(AllowedMember::class);
    }

}
