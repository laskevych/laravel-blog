<?php

namespace Tests\Feature\Api\V1;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\BlogPost;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function testGettingPostsWhenNothingInDatabase()
    {
        $response = $this->json('GET', "api/v1/posts");

        $response->assertStatus(200)
            ->assertJsonStructure(['data', 'links', 'meta'])
            ->assertJsonCount(0, 'data');
    }

    public function testGettingPostsWhenTenPostsInDatabace()
    {
        factory(BlogPost::class, 10)->create([
            'user_id' => $this->user()->id
        ]);

        $response = $this->json('GET', "api/v1/posts");

        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'title',
                        'content',
                        'created_at',
                        'updated_at',
                        'user' => [
                            'id',
                            'name'
                        ],
                        'href' => [
                            'comments'
                        ]
                    ]
                ],
                'links', 
                'meta'
            ])
            ->assertJsonCount(10, 'data');
    }

    public function testGettingOnePost()
    {
        $post = $this->blogPost();

        $response = $this->json('GET', "api/v1/posts/{$post->id}");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $post->id
            ]);
    }

    public function testAddingPostWhenUserAreNotAuthenticated()
    {
        $response = $this->json('POST', "api/v1/posts", [
            'title' => 'Hello John Wick',
            'content' => 'Luckly Content',
            'user_id' => $this->user()->id
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
            ]);
    }

    public function testAddingPostWhenUserAreAuthenticated()
    {
        $user = $this->user();

        $response = $this->actingAs($user, 'api')->json('POST', "api/v1/posts", [
            'title' => 'Hello John Wick',
            'content' => 'Luckly Content',
            'user_id' => $user->id
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'title' => 'Hello John Wick',
                'content' => 'Luckly Content'
            ]);
    }

    public function testAddingPostWithInvalidData()
    {
        $user = $this->user();
        
        $response = $this->actingAs($user, 'api')->json('POST', "api/v1/posts", [
            'title' => 'Hell',
            'content' => '',
            'user_id' => $user->id
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.'
            ]);
    }

    public function testUpdatingPostWhenUserAreAuthenticated()
    {
        $post = $this->blogPost();

        $response = $this->actingAs($post->user, 'api')->json('PUT', "api/v1/posts/{$post->id}", [
            'title' => 'Hello Bittersweet Memories',
            'content' => 'Test API !!!'
        ]);

        $response->assertStatus(200)
            ->assertJson([
                'title' => 'Hello Bittersweet Memories'
        ]);
    }

    public function testUpdatingPostWhenUserAreNotAuthenticated()
    {
        $post = $this->blogPost();

        $response = $this->json('PUT', "api/v1/posts/{$post->id}", [
            'title' => 'Hello Bittersweet Memories',
            'content' => 'Test API !!!'
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
            ]);

    }

    public function testUpdatingPostWhenThisPostDoesNotBelongToThisUser()
    {
        $post = $this->blogPost();

        $user = $this->user();

        $response = $this->actingAs($user, 'api')->json('PUT', "api/v1/posts/{$post->id}", [
            'title' => 'Hello Bittersweet Memories',
            'content' => 'Test API !!!'
        ]);

        $response->assertStatus(403)
            ->assertJson([
                'message' => 'This action is unauthorized.'
        ]);
    }

    public function testDeletingPostWhenUserAreAuthenticated()
    {
        $post = $this->blogPost();

        $response = $this->actingAs($post->user, 'api')->json('DELETE', "api/v1/posts/{$post->id}");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Success.'
            ]);
    }

    public function testDeletingPostWhenUserAreNotAuthenticated()
    {
        $post = $this->blogPost();

        $response = $this->json('DELETE', "api/v1/posts/{$post->id}");

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
            ]);
    }

    public function testDeletingPostWhenThisPostDoesNotBelongToThisUser()
    {
        $post = $this->blogPost();

        $response = $this->actingAs($this->user(), 'api')->json('DELETE', "api/v1/posts/{$post->id}");

        $response->assertStatus(403)
            ->assertJson([
                'message' => 'This action is unauthorized.'
            ]);
    }
}
