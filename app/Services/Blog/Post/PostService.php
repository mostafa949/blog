<?php

namespace App\Services\Blog\Post;

use App\Repository\Blog\Post\PostRepository;
use App\Traits\general\MediaTrait;
use Illuminate\Support\Collection;

class PostService
{
    use MediaTrait;

    protected $postRepository;

    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function all(): Collection
    {
        return $this->postRepository->all();
    }

    // store new post and add image category in storage folder
    public function store($request)
    {
        if ($file = $request->file('image')) {
            $imageName = $this->uploads($file, 'images/blog/posts/', $request->title);
            $this->postRepository->store($request, $imageName);
        }
    }

    public function show($post)
    {
        return $this->postRepository->show($post);
    }

    public function edit($post)
    {
        return $this->postRepository->edit($post);
    }

    public function update($request, $post)
    {
        if ($file = $request->file('image')) {
            $this->delete('blog/posts/', $post->image_path);
            $fileName = $this->updateUpload($file, $post->image_path, 'images/blog/posts/');
        } else {
            $fileName = $post->image_path;
        }
        $this->postRepository->update($request, $fileName, $post);
    }

    public function destroy($post)
    {
        $this->delete('blog/posts/', $post->image_path);
        $this->postRepository->destroy($post);

    }
}
