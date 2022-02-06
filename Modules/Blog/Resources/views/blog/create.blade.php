@extends('blog::layouts.master')

@section('title', 'Create Post')

@section('content')
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl">
                Create Post
            </h1>
        </div>
    </div>

    @if($errors->any())
        <div class="w-4/5 m-auto">
            <ul>
                @foreach($errors->all() as $key => $error)

                    <div id="alert-{{ $key }}" class="w-4/5 m-auto mt-7 flex p-4 mb-4 bg-red-100 rounded-lg dark:bg-red-200" role="alert">
                        <svg class="w-6 h-6 flex-shrink-0 w-5 h-5 text-red-700 dark:text-red-800" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        <div class="ml-3 text-sm font-medium text-red-700 dark:text-red-800">
                            {{ $error }}
                        </div>
                        <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-blue-100 text-red-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300" data-collapse-toggle="alert-{{ $key }}" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        </button>
                    </div>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="w-4/5 m-auto pt-20">
        <form
            action="/blog"
            method="post"
            enctype="multipart/form-data">
            @csrf

            <input
                type="text"
                name="title"
                placeholder="Title..."
                class="bg-transparent block border-2 border-gray-300 w-full h-20 text-4xl outline-none">

            <textarea name="description" id="message" rows="6"
                      class="p-2 bg-transparent block border-2 border-gray-300 w-full h-60 text-4xl outline-none"
                      placeholder="Description..."></textarea>

            <div class="mb-3 xl:w-96">
                <select name="category" class="form-select appearance-none
                  block
                  w-full
                  px-3
                  py-1.5
                  text-base
                  font-normal
                  text-gray-700
                  bg-transparent bg-clip-padding bg-no-repeat
                  border border-solid border-gray-300
                  rounded
                  transition
                  ease-in-out
                  mt-10
                  focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        aria-label="Default select example">
                    <option value="0" selected>Select category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
            </div>

            @include('blog::layouts.upload-file')

            @include('blog::layouts.checkbox-publish')

            <button
                type="submit"
                class="mt-15 uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                Add post
            </button>

        </form>
    </div>


@endsection
