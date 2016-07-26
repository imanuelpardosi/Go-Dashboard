<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Models\User;
use Mockery as m;

class UserTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class);
        $this->repo_user = app()->make('App\Repositories\UserRepository');
    }

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
            ->press('Sign Up')
            ->seePageIs('/dashboard');
    }

    public function testCreate()
    {
        $model = $this->user->make();

        $expected = [
            'id' => 25,
            'name' => $model->name,
            'email' => $model->email,
            'phone' => $model->phone,
            'occupation' => $model->occupation,
            'password' => $model->password,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $return = $this->repo_user->register($model->toArray());
        $this->assertInstanceOf(Illuminate\Database\Eloquent\Model::class, $model);
        //$this->assertEquals($expected, $return->toArray());
    }
}
