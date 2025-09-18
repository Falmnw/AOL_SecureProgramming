<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class OrganizationUser extends Pivot
{
    protected $table = 'organization_users';

    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
