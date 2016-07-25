<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class UserTest extends TestCase
{
    public function testDisplaysRegistrationForm()
    {
        $this->visit('/')
            ->see('Registration')
            ->dontSee('Welcome');
    }

    public function testNewUserRegistration()
    {
        $this->visit('/')
            ->type('nuel', 'name')
            ->type('el@gmail.com', 'email')
            ->type('082267610077', 'phone')
            ->type('back-end', 'occupation')
            ->type('pidel123', 'password')
            ->press('Sign Up');
    }

    public function testDatabase()
    {
        $user = factory(User::class)->make();
        echo ($user);

        // Use model in tests...
    }
}
