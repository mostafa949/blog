<?php

namespace App\Repository\Blog\Category;

use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    public function all(): Collection;
    public function create(array $attributes);
    public function store($request, $newImageName);
    public function update($request, $newImageName, $slug);
}
