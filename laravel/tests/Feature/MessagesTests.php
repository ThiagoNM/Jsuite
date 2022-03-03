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

        $response = $this->post('/api/chats/1/messages', ['message' => 'Hola', "author_id" => '2', "chat_id" => "1"]);
        $response->assertOk();

        $content = $response->getContent();

        $json = json_decode($content);
        return $json->id;
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
        $response = $this->get("/api/chats/{$id}/messages");
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
        $response = $this->put("/api/chats/{$id}/messages/2", ['message' => 'hola prova']);
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
        $response = $this->delete("/api/chats/{$id}/messages/1");
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     * 
     * @depends test_create
     */
    public function test_list($id)
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/chats/{$id}/messages');
        $response->assertOk();
    }

}