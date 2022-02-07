<?php

namespace App\Repository\Blog\Comment;

use Illuminate\Support\Collection;

interface CommentRepositoryInterface
{
    public function all(): Collection;
    public function store($request);
}
