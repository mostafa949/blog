<?php

namespace Modules\Blog\Http\Controllers;

use App\Services\Blog\Category\CategoryService;
use Illuminate\Routing\Controller;
use Illuminate\Support\Collection;
use Modules\Blog\Http\Requests\Category\CreateCategoryRequest;
use Modules\Blog\Http\Requests\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;

        $this->middleware('auth:admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Collection
     */
    public function index()
    {
        return view('blog::categories.index', [
            'categories' => $this->categoryService->all()
        ]);
    }

    public function create()
    {
        return view('blog::categories.create');
    }

    public function store(CreateCategoryRequest $request)
    {
        $this->categoryService->store($request);
        return redirect(route('blog.categories.index'))
            ->with('message', 'Your category has been added.');
    }

    public function show($slug)
    {
        return view('blog::categories.show')
            ->with('category', $this->categoryService->show($slug));
    }

    public function edit($slug)
    {
        return view('blog::categories.edit')
            ->with('category', $this->categoryService->edit($slug));
    }

    public function update(UpdateCategoryRequest $request, $slug)
    {
        $this->categoryService->update($request, $slug);
        return redirect()->route('blog.categories.index');
    }

    public function destroy($slug)
    {
        $this->categoryService->destroy($slug);
        return redirect()->route('blog.categories.index');
    }
}
