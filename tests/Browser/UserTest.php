<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_that_a_user_can_can_list_all_users()
    {
        $user = factory(User::class)->create([
            'email' => 'adam@mail.com',
            'is_admin' => 1
        ]);

        $this->browse(function ($first, $second) use ($user) {
            $first->loginAs($user)
                  ->visit("/users")
                  ->assertSee("All users");
//                  ->assertPresent("#users");
        });
    }
}
