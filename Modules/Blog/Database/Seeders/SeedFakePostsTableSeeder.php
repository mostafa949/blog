<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Entities\Post;

class SeedFakePostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::create([
            'title' => 'PHP',
            'slug' => 'PHP',
            'description' => 'PHP (recursive acronym for PHP: Hypertext Preprocessor) is a widely-used open source general-purpose scripting language that is especially suited for web development and can be embedded into HTML.',
            'image_path' => '61c1c02b35f9a-PHP.png',
            'category_id' => 1,
            'admin_id' => 1
        ]);
        Post::create([
            'title' => 'JavaScript',
            'slug' => 'JavaScript',
            'description' => 'JavaScript (often shortened to JS) is a lightweight, interpreted, object-oriented language with first-class functions, and is best known as the scripting language for Web pages, but it used in many non-browser environments as well. It is a prototype-based, multi-paradigm scripting language that is dynamic, and supports object-oriented, imperative, and functional programming styles.',
            'image_path' => '61c1c16636007-JavaScript.png',
            'category_id' => 1,
            'admin_id' => 1
        ]);
        Post::create([
            'title' => 'Python',
            'slug' => 'Python',
            'description' => 'Python is an interpreted, object-oriented, high-level programming language with dynamic semantics. Its high-level built in data structures, combined with dynamic typing and dynamic binding, make it very attractive for Rapid Application Development, as well as for use as a scripting or glue language to connect existing components together.',
            'image_path' => '61c1c18c51420-Python.jpg',
            'category_id' => 1,
            'admin_id' => 1
        ]);
    }
}
