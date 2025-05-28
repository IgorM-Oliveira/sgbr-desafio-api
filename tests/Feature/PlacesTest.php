<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Places;
use Tests\TestCase;

class PlacesTest extends TestCase
{
    use RefreshDatabase;

    public function test_list_places()
    {
        Places::factory()->create(['name' => 'Praia do Forte']);
        Places::factory()->create(['name' => 'Cristo Redentor']);

        $response = $this->getJson('/api/places');

        $response->assertOk()
                 ->assertJsonFragment(['name' => 'Praia do Forte']);
    }

    public function test_filter_places_by_name(): void
    {
        Places::create([
            'name' => 'Parque das Águas',
            'slug' => 'parque-das-aguas',
            'city' => 'Cuiabá',
            'state' => 'MT',
        ]);

        $response = $this->getJson('/api/places?name=água');

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Parque das Águas']);
    }

    public function test_show_a_place(): void
    {
        $place = Places::create([
            'name' => 'Ilha Bela',
            'slug' => 'ilha-bela',
            'city' => 'Ilhabela',
            'state' => 'SP',
        ]);

        $response = $this->getJson("/api/places/{$place->id}");

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Ilha Bela']);
    }

    public function test_create_place()
    {
        $response = $this->postJson('/api/places', [
            'name' => 'Parque Central',
            'slug' => 'ibirapuera',
            'city' => 'São Paulo',
            'state' => 'SP',
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment(['name' => 'Parque Central']);
    }

    public function test_update_place(): void
    {
        $place = Places::create([
            'name' => 'Parque Velho',
            'slug' => 'parque-velho',
            'city' => 'Sorocaba',
            'state' => 'SP',
        ]);

        $response = $this->putJson("/api/places/{$place->id}", [
            'name' => 'Parque Novo',
            'slug' => 'parque-novo',
            'city' => 'Sorocaba',
            'state' => 'SP',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['name' => 'Parque Novo']);
    }

    public function test_delete_place(): void
    {
        $place = Places::create([
            'name' => 'Parque Temporário',
            'slug' => 'parque-temporario',
            'city' => 'Campinas',
            'state' => 'SP',
        ]);

        $response = $this->deleteJson("/api/places/{$place->id}");

        $response->assertStatus(200)
                 ->assertJson(['message' => 'Lugar removido']);
    }
}
