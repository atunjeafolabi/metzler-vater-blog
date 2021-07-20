<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_that_a_user_cannot_login_with_invalid_credentials()
    {
        $user = factory(User::class)->create([
            'email' => 'adam@mail.com'
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'wrong-password')
                    ->press('Login')
                    ->screenshot('login')
                    ->assertPathIs('/login');
        });
    }

    public function test_that_a_user_can_login_with_correct_credentials()
    {
        $user = factory(User::class)->create([
            'email' => 'adam@mail.com'
        ]);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/login')
                    ->type('email', $user->email)
                    ->type('password', 'password')
                    ->press('Login')
                    ->screenshot('login')
                    ->assertPathIs('/');
        });
    }

    public function test_that_a_new_user_can_register_with_valid_information()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', 'Ben Gates')
                    ->type('email', 'ben@mail.com')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->type('description', 'This is just a short description about Ben Gates')
                    ->attach('avatar', __DIR__.'/../fixtures/images/test-image-for-attach.png')
                    ->press('Register')
                    ->screenshot('register')
                    ->assertPathIs('/');
        });
    }

    /**
     * TODO: to add dataprovider to generate combinations of wrong inputs
     *
     * @throws \Throwable
     */
    public function test_that_a_new_user_cannot_register_with_invalid_information()
    {
        $this->browse(function ($browser) {
            $browser->visit('/register')
                    ->type('name', 'Ben Gates')
                    ->type('email', 'ben@')
                    ->type('password', 'password')
                    ->type('password_confirmation', 'password')
                    ->type('description', 'This is just a short description about Ben Gates')
                    ->press('Register')
                    ->screenshot('register')
                    ->assertPathIs('/register');
        });
    }
}
