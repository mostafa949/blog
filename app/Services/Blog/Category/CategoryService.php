<?php

namespace App\Services\Blog\Category;

use App\Repository\Blog\Category\CategoryRepository;
use App\Traits\general\MediaTrait;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;

class CategoryService
{
    use MediaTrait;

    protected $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function all(): Collection
    {
        return $this->categoryRepository->all();
    }

    // store new category and add image category in storage folder
    public function store($request)
    {
        if ($file = $request->file('image')) {
            $imageName = $this->uploads($file, 'images/blog/categories/', $request->title);
        }

        $this->categoryRepository->store($request, $imageName);
    }

    public function show($slug)
    {
        return $this->categoryRepository->show($slug);
    }

    public function edit($slug)
    {
        return $this->categoryRepository->edit($slug);
    }

    public function update($request, $slug)
    {
        $category = $this->categoryRepository->where($slug);

        if ($file = $request->file('image')) {
            if ($category->image_path) {
                $this->delete('blog/categories/', $category->image_path);
            }

            $newImageName = $this->uploads($file, 'images/blog/categories/', $request->title);
            $this->categoryRepository->update($request, $newImageName, $slug);
        } else {
            $newImageName = $category->image_path;
            $this->categoryRepository->update($request, $newImageName, $slug);
        }
    }

    public function destroy($slug)
    {
        $category = $this->categoryRepository->where($slug);
        $this->delete('blog/categories/', $category->image_path);
        $this->categoryRepository->destroy($category);

    }
}
