<?php

namespace App\Http\Controllers;

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

        $request->merge(['user_id' => auth()->id()]);
        Project::create($request->only('user_id', 'name', 'description'));

        return redirect(route('projects.index'))
            ->with('success', __('¡Proyecto creado!'));
    }

    public function edit(Project $project): Renderable
    {
        $viewModel = new UpsertProjectViewModel($project);
        
        return view('projects.edit', $viewModel->toArray()['form_data']);
    }

    public function update(ProjectRequest $request, Project $project): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required|unique:projects,name,' . $project->id,
            'description' => 'nullable|string|min:10'
        ]);
        $project->fill($request->only('name', 'description'))->save();
        return back()->with('success', __('¡Proyecto actualizado!'));
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();
        return back()->with('success', __('¡Proyecto eliminado!'));
    }
}
