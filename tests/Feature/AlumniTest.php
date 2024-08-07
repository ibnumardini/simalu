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

    public function testCreateAlumniPageIsRendered(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->get(route('alumnis.create'));
        $response->assertStatus(200);
        $response->assertViewIs('dashboard.pages.alumnis.create');
    }

    public function testCreateAlumniPageIsNotRendered(): void
    {
        $response = $this->get(route('alumnis.create'));
        $response->assertStatus(302);
        $response->assertRedirect(route('login'));
    }

    public function testCreateAlumniSuccess(): void
    {
        $user = User::factory()->create();
        $school = School::factory()->create();

        $this->actingAs($user);

        $data = [
            'mobile' => '081234567890',
            'address' => 'Jl. Wanjay Ds. Wanjas',
            'dob' => '2000-01-01',
            'registration_at' => '2024-01-01',
            'graduation_at' => '2024-12-31',
            'school_id' => $school->id,
            'user_id' => $user->id,
        ];

        $response = $this->post(route('alumnis.store'), $data);

        $response->assertRedirect(route('alumnis.index'));
        $response->assertStatus(302);

        $this->assertDatabaseHas('alumnis', [
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'registration_at' => $data['registration_at'],
            'graduation_at' => $data['graduation_at'],
            'school_id' => $data['school_id'],
            'user_id' => $data['user_id'],
        ]);
    }

    public function testCreateAlumniFail(): void
    {
        $user = User::factory()->create();
        $school = School::factory()->create();

        $this->actingAs($user);

        $invalidData = [
            'mobile' => '',
            'address' => '',
            'dob' => '',
            'registration_at' => '',
            'graduation_at' => '',
            'school_id' => $school->id,
            'user_id' => $user->id,
        ];

        $response = $this->post(route('alumnis.store'), $invalidData);

        $this->assertDatabaseMissing('alumnis', $invalidData);

        $response->assertSessionHasErrors([
            'mobile',
            'address',
            'dob',
            'registration_at',
            'graduation_at',
        ]);
    }

    public function testEDitAlumniPageIsRendered(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $alumni = Alumni::factory()->create();

        $response = $this->get(route('alumnis.edit', ["alumni" => $alumni->id]));
        $response->assertStatus(200);
        $response->assertViewHas('alumni');
        $response->assertViewIs('dashboard.pages.alumnis.edit');

        $alumniOnView = $response->viewData('alumni');

        $this->assertEquals($alumni->id, $alumniOnView->id);
    }

    public function testEditAlumniPageIsNotRendered(): void
    {
        $alumni = Alumni::factory()->create();
        $response = $this->get(route('alumnis.edit', ["alumni" => $alumni->id]));

        $response->assertRedirect(route('login'));
    }

    public function testUpdateAlumniSuccess(): void
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $school = School::factory()->create();
        $alumni = Alumni::factory()->create([
            'school_id' => $school->id,
            'user_id' => $user->id,
        ]);

        $this->actingAs($user);

        $data = [
            'mobile' => '081234567891',
            'address' => $alumni->address,
            'dob' => '2000-02-02',
            'registration_at' => '2024-02-01 00:00:00',
            'graduation_at' => '2025-01-01 00:00:00',
            'school_id' => $school->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('alumnis.update', $alumni->id), $data);
        $response->assertStatus(302);
        $response->assertRedirect(route('alumnis.index'));

        $this->assertDatabaseHas('alumnis', [
            'id' => $alumni->id,
            'mobile' => $data['mobile'],
            'address' => $data['address'],
            'dob' => $data['dob'],
            'registration_at' => $data['registration_at'],
            'graduation_at' => $data['graduation_at'],
            'school_id' => $data['school_id'],
            'user_id' => $data['user_id'],
        ]);
    }
}
