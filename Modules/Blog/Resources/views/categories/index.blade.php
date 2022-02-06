@extends('blog::layouts.master')

@section('title', 'Categories')

@section('content')
    <div class="w-4/5 m-auto text-center">
        <div class="py-15 border-b border-gray-200">
            <h1 class="text-6xl">
                Categories
            </h1>
        </div>
    </div>

    @if(session()->has('message'))
        <div class="w-4/5 m-auto mt-10 pl-2">
            <p class="w-2/6 mb-4 text-gray-50 bg-green-500 rounded-2xl py-4">
                {{ session()->get('message') }}
            </p>
        </div>
    @endif

    @auth('admin')
        <div class="pt-15 w-4/5 m-auto">
            <a
                href=" {{route('blog.categories.create')}}"
                class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
                Create category
            </a>
        </div>
    @endauth

    @foreach($categories as $category)
        <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
            <div>
{{--                <img src="{{ URL::to('storage/images/blog/categories/'.$category->image_path) }}" width="500" alt="">--}}
                <img src="{{ categoryStorageFilePath($category->image_path) }}" width="500" alt="">
            </div>
            <div>
                <h2 class="text-gray-700 font-bold text-5xl pb-4">
                    {{$category->title}}
                </h2>
                <span class="text-gray-500">
               By <span class="font-bold italic text-gray-800">{{$category->admin->name}}</span>, Created on {{date('jS M Y', strtotime($category->updated_at))}}
            </span>
                <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                    {{$category->description}}
                </p>
                <a
                    href="{{route('blog.categories.show', ['category' => $category->slug])}}"
                    class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold rounded-3xl py-4 px-8">
                    Keep Reading
                </a>

                @auth('admin')
                    <span class="float-right">
                        <a
                            href="{{route('blog.categories.edit', ['category' => $category->slug])}}"
                            class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">Edit</a>
                    </span>

                    <span class="float-right">
                        <form
                            action="{{route('blog.categories.destroy', ['category' => $category->slug])}}"
                            method="post">
                            @csrf
                            @method('delete')

                            <button type="submit" class="text-red-500 pr-3">Delete</button>
                        </form>
                    </span>
                @endauth

            </div>
        </div>
    @endforeach

@endsection
