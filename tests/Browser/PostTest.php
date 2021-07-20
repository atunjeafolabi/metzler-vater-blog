<?php

namespace Tests\Browser;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class PostTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function test_that_posts_can_be_seen_when_user_is_not_authenticated()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('Metzler Vater Blog')
                    ->assertSee('Login')
                    ->assertSee('Register')
                    ->waitForText('Categories')
                    ->waitForText('Recent Posts')
                    ->assertSee('Posts');
        });
    }

    public function test_that_a_single_post_can_be_seen_when_user_is_not_authenticated()
    {
        $post = factory(Post::class)->create();

        $this->browse(function (Browser $browser) use ($post) {
            $browser->visit("/posts/{$post->slug}")
                    ->assertSee('Metzler Vater Blog')
                    ->assertSee('Login')
                    ->assertSee('Register')
                    ->waitForText('Categories')
                    ->waitForText('Recent Posts')
                    ->assertSee('Posts');
        });
    }

    public function test_that_add_edit_and_delete_buttons_cannot_be_seen_when_user_is_not_authenticated()
    {
        $post = factory(Post::class)->create();

        $this->browse(function (Browser $browser) use ($post) {
            $browser->visit("/posts/{$post->slug}")
                    ->assertMissing(".edit-btn")
                    ->assertMissing(".delete-form")
                    ->assertMissing(".add-new-post")
                    ->assertSee('Login')
                    ->assertSee('Register')
                    ->waitForText('Categories')
                    ->waitForText('Recent Posts')
                    ->assertSee('Posts')
                    ->assertSee('Metzler Vater Blog')
                    ->screenshot('add_edit_delete_button');
        });
    }

    public function test_that_unauthenticated_user_is_redirected_to_login_when_trying_to_visit_create_post_page()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/posts/create')
                    ->assertPathIs('/login');
        });
    }

    public function test_that_unauthenticated_user_is_redirected_to_login_when_trying_to_visit_update_post_page()
    {
        $post = factory(Post::class)->create();
        $slug = $post->slug;

        $this->browse(function (Browser $browser) use ($slug) {
            $browser->visit("/posts/{$slug}/update")
                    ->assertPathIs('/login');
        });
    }

    public function test_that_posts_can_be_seen_when_user_is_authenticated()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($first, $second) use ($user) {
            $first->loginAs($user)
                  ->visit('/')
                  ->assertSee('Posts')
                  ->waitForText('Categories')
                  ->waitForText('Recent Posts')
                  ->assertSee('Metzler Vater Blog');
        });
    }

    public function test_that_add_edit_and_delete_buttons_can_be_seen_when_post_owner_is_authenticated()
    {
        $user = factory(User::class)->create();

        $post = factory(Post::class)->create(['created_by' => $user->id]);

        $this->browse(function ($first, $second) use ($post, $user) {
            $first->loginAs($user)
                  ->visit("/posts/{$post->slug}")
                  ->assertVisible(".edit-btn")
                  ->assertVisible(".delete-form")
                  ->assertVisible(".add-new-post")
                  ->assertSee('Metzler Vater Blog')
                  ->waitForText('Categories')
                  ->waitForText('Recent Posts')
                  ->assertSee('Posts');
//                  ->screenshot('add_edit_and_delete_buttons_can_be_seen_when_post_owner_is_authenticated');
        });
    }

    public function test_that_logout_link_is_visible_to_an_authenticated_user()
    {
        $user = factory(User::class)->create();

        $this->browse(function ($first, $second) use ($user) {
            $first->loginAs($user)
                  ->visit("/")
                  ->assertVisible("#logout-link")
                  ->assertPresent("#logout-form");
        });
    }
}
