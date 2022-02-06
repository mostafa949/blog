<?php

namespace App\Repository\Blog\Post;

use Illuminate\Support\Collection;

interface PostRepositoryInterface
{
    public function all(): Collection;
}
