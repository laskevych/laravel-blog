<?php

use Illuminate\Database\Seeder;
use App\Tag;
use App\BlogPost;
class BlogPostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tagCount = Tag::all()->count();

        if ($tagCount === 0) {
            $this->command->info('No tags found, skipping assigning tags to blog posts :(');
            return;
        }

        $howManyMin = (int)$this->command->ask('Minimus tags on blog post?', 1);
        $howManyMax = min((int)$this->command->ask('Maximum tags on blog post?', $tagCount), $tagCount);

        BlogPost::all()->each(function (BlogPost $post) use($howManyMin, $howManyMax) {
            $take = random_int($howManyMin, $howManyMax);
            $tags_ids = Tag::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tags()->sync($tags_ids);
        });
    }
}
