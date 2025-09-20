<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Auth;

class OrganizationUser extends Pivot
{
    protected $table = 'organization_users';

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
    public function getRoleUser(){
        $user_id = Auth::user()->id;
        return $this->where('user_id', $user_id)->first()->role->name;
    }

}   
