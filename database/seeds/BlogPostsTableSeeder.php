<?php

use Illuminate\Database\Seeder;

class BlogPostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = App\User::all();

        if ($users->count() === 0) {
            $this->command->error('There are not users, so not posts will be added :(');
            return;
        }

        //Question for a terminal
        $postsCount = (int)$this->command->ask('How many posts would you like to be created?', 50);

        $posts = factory(App\BlogPost::class, $postsCount)->make()->each(function($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
