<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;
use Tests\TestCase;

class DocumentTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testExample()
    {
        $response = $this->postJson('/documents',[
            'title' => Str::random(20),
            'content' => Str::random(20),
            'published_at' => Carbon::now()->toDateTimeString(),
        ]);

        $response->dump();

//        dd($response->ge);

        $response->assertStatus(200);
    }
}
