<?php

namespace Tests\Feature\Api;

use App\Models\Company;
use App\Models\Hero;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CompanyTest extends TestCase
{
    protected $endpoint = '/companies';
    /**
     * Get All Companies
     * @test
     */
    public function get_all_companies()
    {
        Company::factory()->count(10)->create();

        $response = $this->getJson($this->endpoint);

        $response->assertJsonCount(6, 'data');
        $response->assertStatus(200);
    }

    /**
     * Error Get Single Hero
     *@test
     * @return void
     */
    public function error_get_single_company()
    {
        $company = 'fake-uuid';

        $response = $this->getJson("{$this->endpoint}/{$company}");

        $response->assertStatus(404);
    }

     /**
     * Get Single Company
     *@test
     * @return void
     */
    public function get_single_company()
    {
        $company = Company::factory()->create();

        $response = $this->getJson("{$this->endpoint}/{$company->uuid}");

        $response->assertStatus(200);
    }

    /**
     * Validation Store Hero
     *@test
     * @return void
     */
    public function validations_store_company()
    {
        $response = $this->postJson($this->endpoint, [
            'name' => '',
        ]);

        $response->assertStatus(422);
    }

    /**
     * Store Hero
     *@test
     * @return void
     */
    public function store_company()
    {
        $hero = Hero::factory()->create();

        $image = UploadedFile::fake()->image('e10.png');

        $response = $this->call(
            'POST',
            $this->endpoint,
            [
                'hero_id' => $hero->id,
                'name' => 'E10',
                'email' => 'contato@e10.com.br'
            ],
            [],
            ['image' => $image]
        );

        $response->assertStatus(201);
    }

    /**
     * Update Hero
     *@test
     * @return void
     */
    public function update_company()
    {
        $company = Company::factory()->create();
        $hero = Hero::factory()->create();

        $data = [
            'hero_id' => $hero->id,
            'name' => 'E10 Company Updated',
            'email' => 'e10@e10.com.br',
        ];

        $response = $this->putJson("$this->endpoint/fake-company", $data);
        $response->assertStatus(404);

        $response = $this->putJson("$this->endpoint/{$company->uuid}", []);
        $response->assertStatus(422);

        $response = $this->putJson("$this->endpoint/{$company->uuid}", $data);
        $response->assertStatus(204);
    }

    /**
     * Delete Company
     *@test
     * @return void
     */
    public function delete_company()
    {
        $company = Company::factory()->create();

        $response = $this->deleteJson("{$this->endpoint}/fake-company");
        $response->assertStatus(404);

        $response = $this->deleteJson("{$this->endpoint}/{$company->uuid}");
        $response->assertStatus(204);
    }
}
