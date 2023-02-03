<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Base\User
{
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class);
    }
}
