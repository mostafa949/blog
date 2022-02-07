<?php

namespace App\Services\Blog\Comment;

use App\Repository\Blog\Comment\CommentRepository;
use Illuminate\Support\Collection;

class CommentService
{
    protected $commentRepository;

    public function __construct(CommentRepository $commentRepository)
    {
        $this->commentRepository = $commentRepository;
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->commentRepository->all();
    }

    // store new post and add image category in storage folder
    public function store($request)
    {
        $this->commentRepository->store($request);
    }


    public function destroy($comment)
    {
        $this->commentRepository->destroy($comment);
    }
}
