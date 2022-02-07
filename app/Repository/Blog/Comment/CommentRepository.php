<?php

namespace App\Repository\Blog\Comment;


use App\Repository\BaseRepository;
use Illuminate\Support\Collection;
use Modules\Blog\Entities\Comment;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Comment $model
     */
    public function __construct(Comment $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->orderBy('updated_at', 'DESC')->get();
    }

    // store new comment
    public function store($request)
    {
        $comment = $this->model;
        if (auth('admin')->check()) {
            $comment->name = auth('admin')->user()->name;
            $comment->admin_id = auth('admin')->user()->id;
        } elseif (auth()->check()) {
            $comment->name = auth()->user()->name;
            $comment->user_id = auth()->user()->id;
        } else {
            $comment->name = $request->input('name');
        }
        $comment->comment = $request->input('comment');
        $comment->post_id = $request->input('post_id');
        $comment->save();

        return $comment->fresh();
    }

    public function destroy($post)
    {
        $post->delete();
        return $post->fresh();
    }

    public function where($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
