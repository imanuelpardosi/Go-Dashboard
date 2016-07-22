<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;

class UserTest extends TestCase
{
    public function testBasicExample()
    {
        $this->visit('/')
            ->see('Registration');
    }

    public function testNewUserRegistration()
    {
        $this->visit('/')
            ->type('Taylor', 'name')
            ->type('el@gmail.com', 'email')
            ->type('082267610077', 'phone')
            ->type('Back-End', 'occupation')
            ->type('pidel123', 'password')
            ->press('Sign Up');
    }
}
