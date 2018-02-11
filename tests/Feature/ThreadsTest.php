<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ThreadsTest extends TestCase
{
    use DatabaseMigrations;

    protected $thread;

    public function setUp()
    {
    	parent::setUp();

    	$this->thread = factory(App\Thread::class)->create();
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
    	$response = $this->get('threads/')
    		->assertSee($this->thread->title);
    }

    public function a_user_can_read_a_single_thread()
    {
    	$this->get($this->thread->path())
    		->assertSee($this->thread->title);
    }
    
    /** @test */
    public function a_user_can_browse_threads()
    {   
        $response = $this->get('/threads');

        $response->assertStatus(200);
    }

    /** @test */
    public function a_user_can_read_replies_that_are_associated_with_a_thread()
    {
    	$reply = factory(App\Reply::class)
    		->create(['thread_id' => $this->thread->thread_id]);

    	$this->get($this->thread->path())
    		->assertSee($reply->body);
    }   

    /** @test */
    public function a_thread_has_replies()
    {
        $thread = factory(App\Thread::class)->create();

        $this->assertInstanceOf(Illuminate\Database\Eloquent\Collection::class, $thread->replies);
    }

    /** @test */
    public function a_thread_as_a_creator()
    {
        $thread = factory(App\Thread::class)->create();

        $this->assertInstanceOf(App\User::class, $thread->creator);
    }

    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'Foobar',
            'user_id' => 1
        ]);

        $this->assertCount(1, $thread->replies);
    }

}
