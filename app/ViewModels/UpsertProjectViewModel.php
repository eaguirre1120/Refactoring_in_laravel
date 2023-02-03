<?php
namespace App\ViewModels;
use App\Models\Project;

final class UpsertProjectViewModel extends ViewModel
{
    public function __construct(public ?Project $project = null) {}

    public function formData(): array
    {
        if ($this->project) 
        {
            return $this->updateFormData();
        }

        return $this->createFormData();
    }

    protected function createFormData(): array
    {
        $project = new Project;
        $title = __('Crear proyecto');
        $textButton = __('Crear');
        $route = route('projects.store');
        return compact('title', 'textButton', 'route', 'project');
    }

    protected function updateFormData(): array
    {
        $project = $this->project;
        $update = true;
        $title = __('Editar proyecto');
        $textButton = __('Actualizar');
        $route = route('projects.update', ['project' => $this->project]);
        return compact('project', 'update', 'title', 'textButton', 'route');
    }
}
