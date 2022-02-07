<?php

namespace Modules\Blog\Http\Controllers;

use App\Services\Blog\Category\CategoryService;
use App\Services\Blog\Post\PostService;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Post;
use Modules\Blog\Http\Requests\Post\CreatePostRequest;
use Modules\Blog\Http\Requests\Post\UpdatePostRequest;

class PostsController extends Controller
{

    private $postService;
    private $categoryService;

    public function __construct(PostService $postService, CategoryService $categoryService)
    {
        $this->postService = $postService;
        $this->categoryService = $categoryService;

        $this->middleware('auth:admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     * @return Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|Collection
     */
    public function index()
    {
        return view('blog::blog.index')
            ->with('posts', $this->postService->all())
            ->with('categories', $this->categoryService->all());
    }

    public function create()
    {
        return view('blog::blog.create')
            ->with('categories', $this->categoryService->all());
    }

    public function store(CreatePostRequest $request)
    {
        $this->postService->store($request);
        return redirect(route('blog.posts.index'))
            ->with('message', 'Your post has been added.');
    }

    public function show(Post $post)
    {
        return view('blog::blog.show')
            ->with('post', $this->postService->show($post));
    }

    public function edit(Post $post)
    {
        return view('blog::blog.edit')
            ->with('post', $this->postService->edit($post));
    }

    public function update(UpdatePostRequest $request, Post $post): \Illuminate\Http\RedirectResponse
    {
        $this->postService->update($request, $post);
        return redirect()->route('blog.posts.index');
    }

    public function destroy(Post $post): \Illuminate\Http\RedirectResponse
    {
        $this->postService->destroy($post);
        return redirect()->route('blog.posts.index');
    }
}
