<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Alumni;
use App\Models\School;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class AlumniTest extends TestCase
{
    use RefreshDatabase;

    public function testAlumniPageSuccessWhenAuthenticated(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        self::actingAs($user);

        $response = $this->get(route('alumnis.index'));
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.pages.alumnis.index');
    }

    public function testAlumniPageFailUnauthenticated(): void
    {
        $response = $this->get(route('alumnis.index'));
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }

    public function testAlumniPagnition(): void
    {
        $user = User::factory()->create();
        self::actingAs($user);

        $total = 35;
        Alumni::factory()->count($total)->create();

        $response = $this->get(route('alumnis.index'));
        $response->assertStatus(200);

        $response->assertViewHas('alumnis');

        self::assertEquals(1, $response['alumnis']->currentPage());
        self::assertEquals(10, $response['alumnis']->perPage());
        self::assertEquals(4, $response['alumnis']->lastPage());
        self::assertEquals(35, $response['alumnis']->total());
    }

    public function testSearchAlumniInAlumniSuccess(): void
    {
        $user = User::factory()->create();
        self::actingAs($user);

        $alumni = Alumni::factory()->create([
            'mobile' => '081234567890',
        ]);

        $searchQuery = '081234567890';

        $response = $this->get(route('alumnis.index', ['q' => $searchQuery]));
        $response->assertStatus(200);

        $response->assertViewHas('alumnis');
        $alumnis = $response->viewData('alumnis');

        $this->assertTrue($alumnis->contains($alumni));
    }

    public function testSearchAlumniInAlumniFail(): void
    {
        $user = User::factory()->create();
        self::actingAs($user);

        $alumni = Alumni::factory()->create([
            'mobile' => '081234567890',
        ]);

        $searchQuery = '081333333333';

        $response = $this->get(route('alumnis.index', ['q' => $searchQuery]));
        $response->assertStatus(200);

        $response->assertViewHas('alumnis');
        $alumnis = $response->viewData('alumnis');

        $this->assertFalse($alumnis->contains($alumni));
    }

    public function testSearchSchoolInAlumniSuccess(): void
    {
        $user = User::factory()->create();
        self::actingAs($user);

        $school = School::factory()->create(['name' => 'Sekolah Wanjay']);
        $alumni = Alumni::factory()->create(['school_id' => $school->id]);

        $searchQuery = 'Sekolah Wanjay';

        $response = $this->get(route('alumnis.index', ['q' => $searchQuery]));

        $response->assertStatus(200);

        $response->assertViewHas('alumnis');
        $alumnisCollection = $response->viewData('alumnis');

        $this->assertTrue($alumnisCollection->contains($alumni));
    }

    public function testSearchSchoolInAlumniFail(): void
    {
        $user = User::factory()->create();
        self::actingAs($user);

        $school = School::factory()->create(['name' => 'Sekolah Wanjay']);
        $alumni = Alumni::factory()->create(['school_id' => $school->id]);

        $searchQuery = 'Chuy School';

        $response = $this->get(route('alumnis.index', ['q' => $searchQuery]));

        $response->assertStatus(200);

        $response->assertViewHas('alumnis');
        $alumnisCollection = $response->viewData('alumnis');

        $this->assertFalse($alumnisCollection->contains($alumni));
    }

    public function testSearchUserInAlumniSuccess(): void
    {
        $user = User::factory()->create(['first_name' => 'Ajay Gale']);
        self::actingAs($user);

        $alumni = Alumni::factory()->create(['user_id' => $user->id]);

        $searchQuery = 'Ajay Gale';

        $response = $this->get(route('alumnis.index', ['q' => $searchQuery]));

        $response->assertStatus(200);

        $response->assertViewHas('alumnis');
        $alumnisCollection = $response->viewData('alumnis');

        $this->assertTrue($alumnisCollection->contains($alumni));
    }

    public function testSearchUserInAlumniFail(): void
    {
        $user = User::factory()->create(['first_name' => 'Ajay Gale']);
        self::actingAs($user);

        $alumni = Alumni::factory()->create(['user_id' => $user->id]);

        $searchQuery = 'Cihuuy';

        $response = $this->get(route('alumnis.index', ['q' => $searchQuery]));

        $response->assertStatus(200);

        $response->assertViewHas('alumnis');
        $alumnisCollection = $response->viewData('alumnis');

        $this->assertFalse($alumnisCollection->contains($alumni));
    }
}
