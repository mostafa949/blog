@extends('blog::layouts.master')

@section('title', 'Blog')

@section('content')
    <div class="w-4/5 m-auto text-center">
        <div class="py-15 border-b border-gray-200">
            <h1 class="text-6xl">
                Blog Posts
            </h1>
        </div>
    </div>

    <div class="pt-10 w-2/5 m-auto flex relative">
        <form
            action="/post-filter"
            method="post"
            class="w-full">
            @csrf
            <select name="category" class="form-select appearance-none
                  block
                  w-4/5
                  px-3
                  py-1.5
                  text-base
                  font-normal
                  text-gray-700
                  bg-transparent bg-clip-padding bg-no-repeat
                  border border-solid border-gray-300
                  rounded-l-2xl
                  transition
                  ease-in-out
                  mt-0
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                    aria-label="Default select example">
                <option value="0" selected>Select category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>

            <button type="submit" class="absolute rounded-r-lg text-white bg-blue-500 hover:bg-[#3b5998]/90 focus:ring-4 focus:ring-[#3b5998]/50 font-medium text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 mr-2 mb-2" style="top: 39px;right: -8px">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                Search
            </button>
        </form>

    </div>

    @if(session()->has('message'))
        <div id="alert-1" class="w-4/5 m-auto mt-7 flex p-4 mb-4 bg-green-100 rounded-lg dark:bg-green-200" role="alert">
            <svg class="w-6 h-6 flex-shrink-0 w-5 h-5 text-green-700 dark:text-green-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <div class="ml-3 text-sm font-medium text-green-700 dark:text-green-800">
                {{ session()->get('message') }}
            </div>
            <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-100 text-green-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-green-200 inline-flex h-8 w-8 dark:bg-green-200 dark:text-green-600 dark:hover:bg-green-300" data-collapse-toggle="alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    @endif

    @auth('admin')
        <div class="pt-15 w-4/5 m-auto">
            <a
                href="{{route('blog.categories.create')}}"
                class="bg-blue-500 uppercase bg-transparent text-gray-100 text-xs font-extrabold py-3 px-5 rounded-3xl">
                Create post
            </a>
        </div>
    @endauth

    @foreach($posts as $post)
        <div class="sm:grid grid-cols-2 gap-20 w-4/5 mx-auto py-15 border-b border-gray-200">
            <div>
                <img src="{{ asset('/images/posts/'.$post->image_path) }}" width="500" alt="">
            </div>
            <div>
                <h2 class="text-gray-700 font-bold text-5xl pb-4">
                    {{$post->title}}
                </h2>
                <span class="text-gray-500">
               By <span class="font-bold italic text-gray-800">{{$post->admin->name}}</span>, Created on {{date('jS M Y', strtotime($post->updated_at))}}<br>
            </span>
                <span class="text-gray-500 block mt-3">Category <span class="font-bold italic text-gray-800 pt-5">{{$post->category->title}}</span>
                <p class="text-xl text-gray-700 pt-8 pb-10 leading-8 font-light">
                    {{$post->description}}
                </p>
                <a
                    href="/blog/{{$post->slug}}"
                    class="uppercase bg-blue-500 text-gray-100 text-lg font-extrabold rounded-3xl py-4 px-8">
                    Keep Reading
                </a>

                @auth('admin')
                    <span class="float-right">
                        <a
                            href="/blog/{{$post->slug}}/edit"
                            class="text-gray-700 italic hover:text-gray-900 pb-1 border-b-2">Edit</a>
                    </span>

                    <span class="float-right">
                        <form
                            action="/blog/{{$post->slug}}"
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
