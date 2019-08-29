<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        $posts = App\BlogPost::all();

        $users = App\User::all();
        
        if ($posts->count() === 0) {
            $this->command->error('There are not blog posts, so not comments will be added :(');
            return;
        }

        if ($users->count() === 0) {
            $this->command->error('There are not users, so not comments will be added :(');
            return;
        }

        //Question for a terminal
        $commentsCount = (int)$this->command->ask('How many comments would you like to be created?', 150);

        factory(App\Comment::class, $commentsCount)->make()->each(function($comment) use ($posts, $users) {
            $comment->commentable_id = $posts->random()->id;
            $comment->commentable_type = 'App\BlogPost';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });

        factory(App\Comment::class, $commentsCount)->make()->each(function($comment) use ($users) {
            $comment->commentable_id = $users->random()->id;
            $comment->commentable_type = 'App\User';
            $comment->user_id = $users->random()->id;
            $comment->save();
        });
    }
}
