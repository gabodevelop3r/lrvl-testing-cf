<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;
use App\Models\Post;

class InterfaceTest extends TestCase
{

    use RefreshDatabase;
    

    # Los test siempre deben recibir la directiva @test igual como esta comentado aca
    /**
     * A basic feature test example.
     *
     * @test
     */
    public function login()
    {
      
        $user = create('App\Models\User',['password'=>Hash::make('passwordtest')]);


        $this->visit('/login')
                ->type($user->email, 'email')
                ->type('passwordtest', 'password')
                ->press('Login') #recibe el nombre del boton o el texto que se encuentre en el
                ->seePageIs('/home');
        
    }

    /** 
     * 
     * @test
     */ 
    public function login_fails(){

        $user = create('App\Models\User',['password'=>Hash::make('passwordtest')]);
                

        $this->visit('/login')
                ->type($user->email, 'email')
                ->type('passwordtest2', 'password')
                ->press('Login') #recibe el nombre del boton o el texto que se encuentre en el
                ->seePageIs('/login')
                ->see('These credentials do not match our records.');

    }


    /** 
     * 
     * @test
     */ 
    public function register(){

        $this->assertEquals(0, User::count());
        $data = [
            'name'=> 'Test name',
            'email'=> 'test@test.com',
            'password'=>'passwordtest'
        ];
        
        $this->visit('/register')
                ->type($data['name'], 'name')
                ->type($data['email'], 'email')
                ->type($data['password'], 'password')
                ->type($data['password'], 'password_confirmation')
                ->press('Register'); #recibe el nombre del boton o el texto que se encuentre en el

        $this->assertEquals(1, User::count());
        
        $user = User::where('name',$data['name'])->first();

        $this->assertEquals($data['name'],$user->name);
                
    }
    
    /**
     *@test
    */
    public function adds_post(){

        $this->assertEquals(0, User::count());
        $user = create('App\Models\User');

        $this->actingAs($user); #crea una sesion (loguea al usuario dentro de la app)

        $data = [
            'title'=> 'Post title',
            'content' => 'Lorem ipsum'
        ];
        

        $this->visit('post/create')
                ->type($data['title'],'title')
                ->type($data['content'],'content')
                ->press('Enviar')
                ->assertResponseStatus(200);
        
        $this->assertEquals(1, Post::count());

    }

}
