<?php

namespace Tests\Feature;

use App\Models\Chat;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ChatsTests extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/chats', ['name' => 'Chat', "author_id" => '2']);
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
        $response = $this->get("/api/chats/{$id}");
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
        $response = $this->put("/api/chats/{$id}", ['name' => 'Chat5']);
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
        $response = $this->delete("/api/chats/{$id}");
        $response->assertStatus(200);
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_list()
    {
        $this->withoutExceptionHandling();
        $response = $this->get('/api/chats');
        $response->assertOk();
    }

}
