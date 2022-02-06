<?php

namespace App\Repository\Blog\Post;


use App\Repository\BaseRepository;
use Illuminate\Support\Collection;
use Modules\Blog\Entities\Post;
use function auth;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        if (auth('admin')->check()) {
            return Post::orderBy('updated_at', 'DESC')->get();
        } else {
            return Post::where('published', true)->orderBy('updated_at', 'DESC')->get();
        }
    }

    public function postsWithRelationship($model)
    {
        return $this->model->with($model)->orderBy('updated_at', 'DESC')->get();
    }

    // This function get latest posts
    public function latestPosts()
    {
        return Post::where('published', true)->orderBy('updated_at', 'DESC')->take(5)->get(['title', 'slug']);
    }
}
