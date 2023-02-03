<?php

namespace App\Models;

use App\Models\Builders\ProjectBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

final class Project extends Base\Project
{
    public function newEloquentBuilder($query): ProjectBuilder
    {
        return new ProjectBuilder($query);
    }   

    public function user() 
    {
        return $this->belongsTo(User::class);
    }
}
