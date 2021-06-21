<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use App\Models\User;

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
    
    
    
    
}
