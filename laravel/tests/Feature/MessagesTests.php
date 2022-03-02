<?php

namespace Tests\Feature;

use App\Models\Message;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MessagesTests extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create()
    {
        $this->withoutExceptionHandling();

        $response = $this->post('/api/chats/40/messages', ['message' => 'Hola', "author_id" => '2', "chat_id" => "40"]);
        $response->assertOk();

        $content = $response->getContent();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * 
     * @depends test_create
     */
    public function test_read($id)
    {
        $this->withoutExceptionHandling();
        $response = $this->get("/api/chats/40/messages");
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * 
     * @depends test_create
     */
    public function test_update($id)
    {
        $this->withoutExceptionHandling();
        $response = $this->put("/api/chats/40/messages/1", ['message' => 'hola prova']);
        $response->assertOk();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * 
     * @depends test_create
     */
    public function test_delete($id)
    {
        $this->withoutExceptionHandling();
        $response = $this->delete("/api/chats/40/messages/1");
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * 
     * @depends test_create
     */
    public function test_list()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/chats/40/messages');
        $response->assertOk();
    }

}
