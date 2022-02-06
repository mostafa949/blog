<?php

namespace App\Services\Blog;

use App\Repository\Blog\BlogRepository;
use Illuminate\Support\Collection;

class BlogService
{
    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function all(): array
    {
        return $this->blogRepository->all();
    }
}
