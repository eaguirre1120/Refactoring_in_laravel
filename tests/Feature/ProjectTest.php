<?php

use App\Models\{User, Project};
use function Pest\Laravel\{actingAs, get};

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    User::factory()->create();
    Project::factory()->times(12)->create();
});

it('app has users')->assertDatabaseHas('users', [
    'id' => 1
]);

it('user not logged cannot access to projects page', function () {
    get('/projects')
        ->assertRedirect('/login');
});

it('user logged can access to projects page', function () 
{
    actingAs(User::first())
        ->get('/projects')
        ->assertStatus(200);
});

it('user logged can access to create project page', function () {
    actingAs(User::first())
        ->get('/projects/create')
        ->assertStatus(200);
});

it('user logged can create a project', function () {
    actingAs(User::first())
        ->post('/projects', [
            'name' => 'Project title',
            'description' => 'Project description',
        ])
        ->assertRedirect('/projects')
        ->assertSessionHas('success', __('¡Proyecto creado!'));
});

it('user logged can access to edit project page', function () {
    $user = User::first();
    $project = $user->projects()->create([
        'user_id' => $user->id,
        'name' => 'Project name',
        'description' => 'Project description',
    ]);

    actingAs($user)
        ->get("/projects/{$project->id}/edit")
        ->assertStatus(200);
});

it('user logged can edit project', function () {
    $user = User::first();
    $project = $user->projects()->create([
        'user_id' => $user->id,
        'name' => 'Project name',
        'description' => 'Project description',
    ]);

    actingAs($user)
        ->put("/projects/{$project->id}", [
            'name' => 'Project name updated', 
            'description' => 'Project description updated', 
        ])
        ->assertRedirect('/projects')
        ->assertSessionHas('success', __('¡Proyecto actualizado!'));
});

it('user logged can delete a project', function () {
    $user = User::first();
    $project = $user->projects()->create([
        'user_id' => $user->id,
        'name' => 'Project name',
        'description' => 'Project description',
    ]);

    actingAs($user)
        ->delete("/projects/{$project->id}")
        ->assertRedirect('/projects')
        ->assertSessionHas('success', __('¡Proyecto eliminado!'));
});
