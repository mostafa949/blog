<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (auth('admin')->check()) {
            $posts = Post::orderBy('updated_at', 'DESC')->get();
        } else {
            $posts = Post::where('published', true)->orderBy('updated_at', 'DESC')->get();
        }
        return view('blog.index')
            ->with('posts', $posts)
            ->with('categories', Category::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('blog.create')
            ->with('categories', $categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'required|mimes:jpg,png,jpeg|max:5048',
            'category' => 'required|not_in:0'
        ]);

        $newImageName = uniqid() . '-' . str_replace(' ', '-', $request->title) . '.' . $request->image->extension();

        $request->image->move(public_path('images/posts/'), $newImageName);

        $post = new Post();
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->slug = $request->input('slug');
        $post->image_path = $newImageName;
        $post->published = $request->has('publish');
        $post->category_id = $request->input('category');
        $post->admin_id = auth('admin')->user()->id;
        $post->save();

        return redirect('/blog')
            ->with('message', 'Your post has been added.');
    }

    /**
     * Display the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show($slug)
    {
        return view('blog.show')
            ->with('post', Post::where('slug', $slug)->first());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $categories = Category::all();

        return view('blog.edit')
            ->with('post', Post::where('slug', $slug)->first())
            ->with('categories', $categories);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'sometimes|mimes:jpg,png,jpeg|max:5048',
            'category' => 'required|not_in:0'
        ]);

        $post = Post::where('slug', $slug)->first();
        if ($request->has('image')) {
            if ($post->image_path) {
                unlink(public_path() . '/images/posts/' . $post->image_path);
            }

            $newImageName = uniqid() . '-' . str_replace(' ', '-', $request->title) . '.' . $request->image->extension();

            $request->image->move(public_path('images/posts/'), $newImageName);
        } else {
            $newImageName = $post->image_path;
        }

        Post::where('slug', $slug)
            ->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'slug' => SlugService::createSlug(Post::class, 'slug', $request->title),
                'image_path' => $newImageName,
                'published' => $post->published = $request->has('publish'),
                'category_id' => (int)$request->input('category'),
                'admin_id' => auth('admin')->user()->id
            ]);

        return redirect('/blog')
            ->with('message', 'Your post has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $slug
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy($slug)
    {
        Post::where('slug', $slug)
            ->delete();

        return redirect('/blog')
            ->with('message', 'Your post has been deleted.');
    }
}
