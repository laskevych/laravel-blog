<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\BlogPost;
use App\Comment;

class PostTest extends TestCase
{
    use RefreshDatabase;
 
    public function testNoBlogPostsWhenNothingInDatabase()
    {
        $response = $this->get('/posts');

        $response->assertSeeText('No blog posts yet!');
    }

    public function testSeeOneBlogPostWhenThereIsOne()
    {
        // Three parts of the Test

        // 1. Arrange
        $post = new BlogPost();
        $post->title = 'Test title';
        $post->content = 'Test content';
        $post->user_id = $this->user()->id;
        $post->save();

        //$post = $this->createDummyBlogPost();

        // 2. Act
        $response = $this->get('/posts');

        // 3. Assert
        $response->assertSeeText('Test title');

        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Test title'
        ]);
    }

    public function testStoreValid()
    {
        // Create fake user
        $user = $this->user();

        $params = [
            'title' => 'Valid title',
            'content' => 'At least 10 characters'
        ];

        // Tru auth with new user
        $this->actingAs($user);

        // 302 status is success added. Than check the session
        $this->post('/posts', $params)
            ->assertStatus(302)
            ->assertSessionHas('status');

        $this->assertEquals(session('status'), 'Blog post was created!');

        // Check database
        $this->assertDatabaseHas('blog_posts', [
            'title' => 'Valid title'
        ]);
    }

    public function testStoreFail()
    {
        $params = [
            'title' => 'x',
            'content' => 'x'
        ];

        $this->actingAs($this->user())
        ->post('/posts', $params)
        ->assertStatus(302)
        ->assertSessionHas('errors');

        $messeges = session('errors')->getMessages();
        $this->assertEquals($messeges['title'][0], 'The title must be at least 5 characters.');
    }

    public function testUpdateValid()
    {
         // 1. Arrange
         // DRY !!!
         $user = $this->userAdmin();
         $post = $this->createDummyBlogPost($user->id);

        // Check database
        $this->assertDatabaseHas('blog_posts', $post->toArray());

        $params = [
            'title' => 'Valid title 5',
            'content' => 'At least 10 characters'
        ];

        // 302 status is success added. Than check the session
        $this->actingAs($user)
            ->put("/posts/{$post->id}", $params)
            ->assertStatus(302)
            ->assertSessionHas('status')
            ;

        // Check database
        $this->assertDatabaseMissing('blog_posts', $post->toArray());
    }

    public function testDeleteValid()
    {
        // 1. Arrange
        $user = $this->user();
        $post = $this->createDummyBlogPost($user->id);

       // Check database
       $this->assertDatabaseHas('blog_posts', $post->toArray());

        // 302 status is success added. Than check the session
        $this->actingAs($user)
            ->delete("/posts/{$post->id}")
            ->assertStatus(302)
            ->assertSessionHas('status');
        

        $this->assertSoftDeleted('blog_posts', $post->toArray());
    }

    public function testSeeOneBlogPostWithComments()
    {
        $user = $this->user();
        $post = $this->createDummyBlogPost();
        factory(Comment::class, 4)->create([
            'commentable_id' => $post->id,
            'commentable_type' => 'App\BlogPost',
            'user_id' => $user->id
        ]);

    
        $response = $this->get('/posts');

        $response->assertSeeText('4 comments');
    }
    private function createDummyBlogPost($userId = null): BlogPost
    {
        return factory(BlogPost::class)->states('new-title')->create([
            'user_id' => $userId ?? $this->user()->id
        ]);
    }
}
