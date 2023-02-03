<?php

namespace App\Actions;

use App\Models\Project;

final class DeleteProjectAction
{
    public static function execute(int $id): void
    {
        Project::find($id)->delete();
    }
}
