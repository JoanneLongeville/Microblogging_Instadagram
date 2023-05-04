<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    public function test_new_post_can_be_published(): void
    {
        $response = $this->post('/posts/create', [
            'id' => '1',
            'description' => 'La description du post.',
            'img_url' => 'posts/u1FrNneLNu52FXQ3RfDfEvT3BMQqJRGuW3MURYpU.jpg',
        ]);

        $this->assertDatabaseHas('posts', [
            'img_url' => 'posts/U6ROch6dtgjrk3Qmxzq8pBBH38ZdBIEvZcUWkM3N.jpg',
        ]);
    
        $response->assertRedirect("/posts");
    }
}
