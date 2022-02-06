<?php

namespace App\Repository\Blog\Category;


use App\Repository\BaseRepository;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Collection;
use Modules\Blog\Entities\Category;
use function auth;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    // store new category and add image category in storage folder
    public function store($request, $imageName)
    {
        $category = new $this->model;
        $category->title = $request->input('title');
        $category->description = $request->input('description');
        $category->image_path = $imageName;
        $category->admin_id = auth('admin')->user()->id;
        $category->save();

        return $category->fresh();
    }

    public function show($slug)
    {
        return $this->where($slug);
    }

    public function edit($slug)
    {
        return $this->where($slug);
    }

    public function update($request, $newImageName, $slug)
    {
        $this->model->where('slug', $slug)
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'slug' => SlugService::createSlug($this->model, 'slug', $request->title),
                'image_path' => $newImageName,
                'admin_id' => auth('admin')->user()->id
            ]);
    }

    public function destroy($category)
    {
        $category->delete();
    }

    public function where($slug)
    {
        return $this->model->where('slug', $slug)->first();
    }
}
