<?php

namespace Tests\Browser;

use App\Models\User;
use App\Models\Project;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;

class ProjectsTest extends DuskTestCase
{

    use DatabaseTransactions;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs(User::first());
    }

    /** @test */
    public function user_not_login_cannot_access_to_projects_page()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->visit('/projects')
                ->assertPathIs('/login');
        });
    }

    /** @test */
    public function user_logged_can_access_to_projects_page()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::first())
                ->visit('/projects')
                ->assertPathIs('/projects')
                ->assertSee(
                    Project::forCurrentUser()->latest()->first()->name
                )
                ->logout();
        });
    }

    /** @test */
    public function user_logged_can_crete_a_project()
    {
        $this->browse(function (Browser $browser) {
            $browser
            ->loginAs(User::first())
                ->visit('/projects/create')
                ->assertPathIs('/projects/create')
                ->assertSee('Crear')
                ->type('name', $this->faker->name)
                ->type('description', $this->faker->words(10))
                ->press('Crear')
                ->assertPathIs('/projects')
                ->assertSee('¡Proyecto creado!')
                ->logout();
        });
    }

    /** @test */
    public function user_logged_can_edit_a_project()
    {
        $this->browse(function (Browser $browser) {
            $project = Project::forCurrentUser()->latest()->first();
            $browser
                ->loginAs(User::first())
                ->visit("/projects/{$project->id}/edit")
                ->assertPathIs("/projects/{$project->id}/edit")
                ->assertSee('Editar')
                ->type('name', 'Project name test v2')
                ->type('description', 'Project description test v2')
                ->screenshot('form_edit_a_project')
                ->press('Actualizar')
                ->assertPathIs('/projects')
                ->assertSee('¡Proyecto actualizado!')
                ->screenshot('can_edit_a_project')
                ->logout();
        });
    }

    /** @test */
    public function user_logged_can_delete_a_project()
    {
        $this->browse(function (Browser $browser) {
            $browser
                ->loginAs(User::first())
                ->visit("/projects")
                ->assertPathIs("/projects")
                ->assertSee('Eliminar')
                ->clickLink('Eliminar')
                ->assertPathIs('/projects')
                ->assertSee('¡Proyecto eliminado!')
                ->logout();
        });
    }

}
