<?php

namespace Modules\Blog\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Blog\Entities\Category;

class SeedFakeCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'title' => 'Programming Language',
            'slug' => 'Programming-Language',
            'description' => 'A programming language is a formal language comprising a set of strings that produce various kinds of machine code output. Programming languages are one kind of computer language, and are used in computer programming to implement algorithms.',
            'image_path' => '61c1c334915ee-Programming-Language.jpg',
            'admin_id' => 1
        ]);
        Category::create([
            'title' => 'Engineering',
            'slug' => 'Engineering',
            'description' => 'Engineering is the use of scientific principles to design and build machines, structures, and other items, including bridges, tunnels, roads, vehicles, and buildings.[1] The discipline of engineering encompasses a broad range of more specialized fields of engineering, each with a more specific emphasis on particular areas of applied mathematics, applied science, and types of application. See glossary of engineering.',
            'image_path' => '61c1c3976ed79-Engineering.jpg',
            'admin_id' => 1
        ]);
    }
}
