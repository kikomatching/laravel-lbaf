<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateThreadsTest extends TestCase
{
	use DatabaseMigrations;

	public function guests_may_not_create_threads()
	{
		$this->expectException(Illuminate\Auth\AuthenticationException::class);

		$thread = make(App\Thread::class);

    	$this->post('threads/', $thread->toArray());
	}

    /** @test */
    public function an_authenticated_user_can_create_new_forum_threads()
    {
    	$this->actingAs(create(App\User::class));

    	$thread = make(App\Thread::class);

    	$this->post('threads/', $thread->toArray());

    	$this->get($thread->path())
    		->assertSee($thread->title)
    		->assertSee($thread->body);
    }
}
