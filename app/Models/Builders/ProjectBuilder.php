<?php

namespace App\Models\Builders;

use Illuminate\Database\Eloquent\Builder;


final class ProjectBuilder extends Builder
{
    final public function forCurrentUser(): Builder
    {
        return $this->where('user_id', auth()->id());
    }
}
