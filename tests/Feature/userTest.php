<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

use App\Models\User;

class userTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @test
     */

     public function adds_user(){

        $this->assertEquals(0, User::count()); # por defecto tener 0 usuarios 
        User::factory()->create();
        $this->assertEquals(1, User::count()); # por defecto tener 0 usuarios 

        
     }

    
}
