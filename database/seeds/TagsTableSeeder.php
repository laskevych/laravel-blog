<?php

use Illuminate\Database\Seeder;
use App\Tag;
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = "gaming#rpg#rog#gamer#ea#pubg#fortnite#gtav#capcom#ubisoft#bethesda#activision#blizzard#rockstargames#microsoft#ps4#playstation#psvita#psgamer#xboxone#switch";
        $resultTags = explode('#', $data);
        $tags = collect($resultTags);
        $tags->each(function ($tagName) {
            $tag = new Tag();
            $tag->name = $tagName;
            $tag->save();
        });
    }
}
