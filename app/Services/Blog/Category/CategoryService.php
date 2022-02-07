<?php

namespace App\Services\Blog\Category;

use App\Repository\Blog\Category\CategoryRepository;
use App\Traits\general\MediaTrait;
use Illuminate\Support\Collection;

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
            $this->categoryRepository->store($request, $imageName);
        }
    }

    public function show($category)
    {
        return $this->categoryRepository->show($category);
    }

    public function edit($category)
    {
        return $this->categoryRepository->edit($category);
    }

    public function update($request, $category)
    {
        if ($file = $request->file('image')) {
            $this->delete('blog/categories/', $category->image_path);
            $fileName = $this->updateUpload($file, $category->image_path, 'images/blog/categories/');
        } else {
            $fileName = $category->image_path;
        }
        $this->categoryRepository->update($request, $fileName, $category);
    }

    public function destroy($category)
    {
        $this->delete('blog/categories/', $category->image_path);
        $this->categoryRepository->destroy($category);

    }
}
