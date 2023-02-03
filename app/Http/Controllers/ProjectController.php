<?php

namespace App\Http\Controllers;

use App\Actions\UpsertProjectAction;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\ViewModels\UpsertProjectViewModel;
use Illuminate\Contracts\Support\Renderable;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProjectController extends Controller
{

    public function index(): Renderable
    {
        $projects = Project::with('user')->latest()->paginate(10);
        return view('projects.index', compact('projects'));
    }

    public function create(): Renderable
    {
        $viewModel = new UpsertProjectViewModel();

        return view('projects.create', $viewModel->toArray()['form_data']);
    }

    public function store(ProjectRequest $request): RedirectResponse
    {

        UpsertProjectAction::execute(auth()->user(), $request);

        return redirect(route('projects.index'))
            ->with('success', __('¡Proyecto creado!'));
    }

    public function edit(Project $project): Renderable
    {
        $viewModel = new UpsertProjectViewModel($project);
        
        return view('projects.edit', $viewModel->toArray()['form_data']);
    }

    public function update(ProjectRequest $request): RedirectResponse
    {
        UpsertProjectAction::execute(auth()->user(), $request);

        return redirect(route('projects.index'))
            ->with('success', __('¡Proyecto actualizado!'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();
        return back()->with('success', __('¡Proyecto eliminado!'));
    }
}
