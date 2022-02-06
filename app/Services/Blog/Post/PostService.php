<?php

namespace App\Services\Blog\Post;

use App\Repository\Blog\Post\PostRepository;
use Illuminate\Support\Collection;

class PostService
{
    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function all(): Collection
    {
        return $this->postRepository->all();
    }

    public function latestPosts()
    {
        return $this->postRepository->latestPosts();
    }
}
