<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ParticipateInForum extends TestCase
{	
	use DatabaseMigrations;

	/** @test */
	public function unauthenticated_user_may_not_add_replies()
	{
		$this->expectException(Illuminate\Auth\AuthenticateException::class);

		$this->post('thread/1/replies', $reply->toArray());
	}

    /** @test */	
    public function an_authenticated_user_may_particapte_in_forum_threads()
    {
        $this->be($user = factory(App\User::class)->create());

        $thread = factory(App\Thread::class)->create();

        $reply = factory(App\Reply::class)->create();

        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
        	->assertSee($reply->body);

    }

}
