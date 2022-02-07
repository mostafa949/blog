<?php

namespace App\Repository\Blog\Post;

use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    public function all(): Collection;
    public function create(array $attributes);
    public function store($request, $imageName);
    public function update($request, $fileName, $post);
}
