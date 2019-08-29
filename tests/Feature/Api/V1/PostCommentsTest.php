<?php

namespace Tests\Feature\Api\V1;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\BlogPost;
use App\Comment;

class PostCommentsTest extends TestCase
{
    use RefreshDatabase;
    
    public function testPostDoesNotHaveComments()
    {
        $post = $this->blogPost();
       
        $responce = $this->json('GET', "api/v1/posts/{$post->id}/comments");

        $responce->assertStatus(200)
            ->assertJsonStructure(['data', 'links', 'meta'])
            ->assertJsonCount(0, 'data');
    }

    public function testPostHasTenComments()
    {
        $post = $this->blogPost();

        $post->comments()
            ->saveMany(factory(Comment::class, 10)->make([
                'user_id' => $post->user_id
            ])
        );

        $responce = $this->json('GET', "api/v1/posts/{$post->id}/comments");

        $responce->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'content',
                        'created_at',
                        'updated_at',
                        'user' => [
                            'id',
                            'name'
                        ] 
                    ]
                ], 
                'links', 
                'meta'
            ])
            ->assertJsonCount(10, 'data');
    }

    public function testGettingOneComment()
    {
        $post = $this->blogPost();

        $comment = $post->comments()->save(factory(Comment::class)->make([
            'user_id' => $post->user_id
            ])
        );

        $response = $this->json('GET', "api/v1/posts/{$post->id}/comments/$comment->id");

        $response->assertStatus(200)
            ->assertJson([
                'id' => $comment->id
        ]);
    }
    
    public function testAddingCommentWhenUserAreNotAuthenticated()
    {
        $post = $this->blogPost();

        $responce = $this->json('POST',  "api/v1/posts/{$post->id}/comments", [
            'content' => 'Test api comment!!!'
        ]);

        $responce->assertStatus(401)->assertJson([
            'message' => 'Unauthenticated.'
        ]);
    }

    public function testAddingCommentWhenUserAreAuthenticated()
    {
        $post = $this->blogPost();

        $responce = $this->actingAs($post->user, 'api')->json('POST',  "api/v1/posts/{$post->id}/comments", [
            'content' => 'Test api comment!!!'
        ]);

        $responce->assertStatus(201);
    }

    public function testAddingCommentWithInvalidData()
    {
        $post = $this->blogPost();

        $responce = $this->actingAs($post->user, 'api')->json('POST',  "api/v1/posts/{$post->id}/comments", [
            'content' => ''
        ]);

        $responce->assertStatus(422)
            ->assertJson([
                'message' => 'The given data was invalid.'
            ]);
    }

    public function testUpdatingCommentWhenUserAreAuthenticated()
    {
        $post = $this->blogPost();

        $comment = $post->comments()->save(factory(Comment::class)->make([
            'user_id' => $post->user_id
            ])
        );

        $response = $this->actingAs($post->user, 'api')
            ->json('PUT', "api/v1/posts/{$post->id}/comments/$comment->id", [
                'content' => 'Hello API'
            ]);

        $response->assertStatus(200)
            ->assertJson([
                'id' => $comment->id,
                'content' => 'Hello API'
        ]);
    }

    public function testUpdatingCommentWhenUserAreNotAuthenticated()
    {
        $post = $this->blogPost();

        $comment = $post->comments()->save(factory(Comment::class)->make([
            'user_id' => $post->user_id
            ])
        );

        $response = $this->json('PUT', "api/v1/posts/{$post->id}/comments/$comment->id", [
            'content' => 'Hello API'
        ]);

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.'
        ]);
    }

    public function testUpdatingCommentWhenThisCommentDoesNotBelongToThisUser()
    {
        $post = $this->blogPost();

        $user = $this->user();

        $comment = $post->comments()->save(factory(Comment::class)->make([
            'user_id' => $post->user_id
            ])
        );

        $response = $this->actingAs($user, 'api')
            ->json('PUT', "api/v1/posts/{$post->id}/comments/$comment->id", [
                'content' => 'Hello API'
            ]);

        $response->assertStatus(403)
            ->assertJson([
                'message' => 'This action is unauthorized.',
        ]);
    }

    public function testDeletingCommentWhenUserAreAuthenticated()
    {
        $post = $this->blogPost();

        $comment = $post->comments()->save(factory(Comment::class)->make([
            'user_id' => $post->user_id
            ])
        );

        $response = $this->actingAs($post->user, 'api')
            ->json("DELETE", "api/v1/posts/{$post->id}/comments/$comment->id");

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Success.',
        ]);
    }

    public function testDeletingCommentWhenUserAreNotAuthenticated()
    {
        $post = $this->blogPost();

        $comment = $post->comments()->save(factory(Comment::class)->make([
            'user_id' => $post->user_id
            ])
        );

        $response = $this->json("DELETE", "api/v1/posts/{$post->id}/comments/$comment->id");

        $response->assertStatus(401)
            ->assertJson([
                'message' => 'Unauthenticated.',
        ]);
    }

    public function testDeletingCommentWhenThisCommentDoesNotBelongToThisUser()
    {
        $post = $this->blogPost();

        $user = $this->user();

        $comment = $post->comments()->save(factory(Comment::class)->make([
            'user_id' => $post->user_id
            ])
        );

        $response = $this->actingAs($user, 'api')
            ->json("DELETE", "api/v1/posts/{$post->id}/comments/$comment->id");

        $response->assertStatus(403)
            ->assertJson([
                'message' => 'This action is unauthorized.',
        ]);
    }
}
