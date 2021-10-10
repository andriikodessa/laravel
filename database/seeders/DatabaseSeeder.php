<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = \App\Models\Category::factory(10)->create();
        $tags = \App\Models\Tag::factory(100)->create();

        $posts = \App\Models\Post::factory(10)->make();
        $posts->each(function (Post $post) use ($categories) {
            $post->category()->associate($categories->random());
            $post->save();
        });

        $posts->each(function (Post $post) use ($tags) {
            $post->tags()->attach($tags->random(3, 5)->pluck('id'));
            $post->save();
        });

    }
}
