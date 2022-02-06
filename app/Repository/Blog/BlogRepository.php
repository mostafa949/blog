<?php

namespace App\Repository\Blog;


use App\Repository\BaseRepository;
use App\Repository\Blog\Category\CategoryRepository;
use App\Repository\Blog\Post\PostRepository;
use Illuminate\Support\Collection;

class BlogRepository extends BaseRepository implements BlogRepositoryInterface
{
    protected $categoryRepository;
    protected $postRepository;

    public function __construct(CategoryRepository $categoryRepository, PostRepository $postRepository)
    {
        $this->categoryRepository = $categoryRepository;
        $this->postRepository = $postRepository;
    }

    public function all(): array
    {
        $result['categories'] = $this->categoryRepository->all();
        $result['posts'] = $this->postRepository->postsWithRelationship('category');
        return $result;
    }
}
