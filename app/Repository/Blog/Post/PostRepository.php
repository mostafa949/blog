<?php

namespace App\Repository\Blog\Post;


use App\Repository\BaseRepository;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Collection;
use Modules\Blog\Entities\Post;

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
        return $this->model->orderBy('updated_at', 'DESC')->get();
    }

    // store new category and add image category in storage folder
    public function store($request, $imageName)
    {

        $post = new $this->model;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->image_path = $imageName;
        $post->published = $request->has('publish');
        $post->category_id = $request->input('category');
        $post->admin_id = auth('admin')->user()->id;
        $post->save();

        return $post->fresh();
    }

    public function show($post)
    {
        return $post;
    }

    public function edit($post)
    {
        return $post;
    }

    public function update($request, $fileName, $post)
    {
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->slug = SlugService::createSlug($post, 'slug', $request->title);
        $post->image_path = $fileName;
        $post->published = $request->has('publish');
        $post->category_id = (int)$request->input('category');
        if (!empty(auth('admin')->user()->id)) {
            $post->admin_id = auth('admin')->user()->id;
        }
        $post->save();
        return $post->fresh();
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

    public function postsWithRelationship($model)
    {
        return $this->model->with($model)->orderBy('updated_at', 'DESC')->get();
    }

    // This function get latest posts
    public function latestPosts()
    {
        return $this->model->where('published', true)->orderBy('updated_at', 'DESC')->take(5)->get(['title', 'slug']);
    }
}
