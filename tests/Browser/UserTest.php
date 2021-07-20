<?php

namespace Tests\Browser;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UserTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_cannot_list_users_when_unauthenticated()
    {
        $this->browse(function ($browser) {
            $browser->visit("/users")
                    ->assertPathIs("/login");
        });
    }

    public function test_that_an_authenticated_ordinary_user_cannot_list_users()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                    ->visit("/users")
                    ->assertTitle("Unauthorized");
        });
    }

    public function test_that_an_authenticated_ordinary_user_cannot_see_create_user_form()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                    ->visit("/users/create")
                    ->assertTitle("Unauthorized");
        });
    }

    public function test_that_an_authenticated_ordinary_user_cannot_see_user_update_form_of_others()
    {
        $user1 = factory(User::class)->create();
        $user2 = factory(User::class)->create();

        $this->browse(function ($browser) use ($user1, $user2) {
            $browser->loginAs($user1)
                    ->visit("/users/{$user2->id}/update")
                    ->assertTitle("Forbidden");
        });
    }

    public function test_that_an_authenticated_ordinary_user_can_see_their_own_user_update_form()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($browser) use ($user) {
            $browser->loginAs($user)
                    ->visit("/users/{$user->id}/update")
                    ->assertTitle("Edit Post");
        });
    }

    //TODO: test that an authenticated ordinary user can actually update their own user profile
    //TODO: test that an authenticated ordinary user cannot update other users profile
}
