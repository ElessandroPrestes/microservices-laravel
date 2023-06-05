<?php

namespace Tests\Feature\Api;

use App\Models\Hero;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HeroTest extends TestCase
{
    protected $endpoint = '/heroes';
    /**
     * Get All Heroes
     */
    public function test_get_all_heroes()
    {
        Hero::factory()->count(6)->create();

        $response = $this->getJson($this->endpoint);

        $response->assertJsonCount(6, 'data');
        $response->assertStatus(200);
    }

     /**
     * Error Get Single Hero
     *
     * @return void
     */
    public function test_error_get_single_hero()
    {
        $hero = 'fake-url';

        $response = $this->getJson("{$this->endpoint}/{$hero}");

        $response->assertStatus(404);
    }

    /**
     * Get Single Hero
     *
     * @return void
     */
    public function test_get_single_hero()
    {
        $hero = Hero::factory()->create();

        $response = $this->getJson("{$this->endpoint}/{$hero->id}");

        $response->assertStatus(200);
    }

    /**
     * Validation Store Hero
     *
     * @return void
     */
    public function test_validations_store_hero()
    {
        $response = $this->postJson($this->endpoint, [
            'name' => '',
            'alias' => '',
            'power' => ''
        ]);

        $response->assertStatus(422);
    }

    /**
     * Store Hero
     *
     * @return void
     */
    public function test_store_hero()
    {
        $response = $this->postJson($this->endpoint, [
            'name' => 'Hero 01',
            'alias' => 'Super Hero',
            'power' => 'Agility'
        ]);

        $response->assertStatus(201);
    }

    /**
     * Update Hero
     *
     * @return void
     */
    public function test_update_hero()
    {
        $hero = Hero::factory()->create();

        $data = [
            'name' => 'Hero Updated',
            'alias' => 'Super Hero Updated',
            'power' => 'Super human'
        ];

        $response = $this->putJson("$this->endpoint/fake-hero", $data);
        $response->assertStatus(404);

        $response = $this->putJson("$this->endpoint/{$hero->id}", []);
        $response->assertStatus(422);

        $response = $this->putJson("$this->endpoint/{$hero->id}", $data);
        $response->assertStatus(204);
    }

    /**
     * Delete Hero
     *
     * @return void
     */
    public function test_delete_hero()
    {
        $hero = Hero::factory()->create();

        $response = $this->deleteJson("{$this->endpoint}/fake-hero");
        $response->assertStatus(404);

        $response = $this->deleteJson("{$this->endpoint}/{$hero->id}");
        $response->assertStatus(204);
    }

}
