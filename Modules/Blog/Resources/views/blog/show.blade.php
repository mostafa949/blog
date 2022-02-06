@extends('blog::layouts.master')

@section('title', 'Post '. $post->title)

@section('content')
    <div class="w-4/5 m-auto text-left mt-10">
        <a href="#"
           class="flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
            <img class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
                 src="{{ asset('images/posts/'. $post->image_path) }}" alt="">
            <div class="flex flex-col justify-between p-4 leading-normal">
                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $post->title }}</h5>
                <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $post->description }}</p>
            </div>
        </a>
    </div>

    {{--add comment--}}
    <div class="w-4/5 m-auto pt-10 items-center">

        <div class="w-1/2 bg-white p-2 pt-4 rounded shadow-lg">

            <form
                action="/comments"
                method="post">
                @csrf
                <div class="mt-3 p-3 w-full">
                    @if(!auth('admin')->check())
                        <input type="text" name="name" placeholder="your name"
                               class="mb-5 px-4 py-1 border border-gray-200">
                    @endif

                    <textarea name="comment" id="message" rows="6"
                              class="block p-2 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                              placeholder="Leave a comment..."></textarea>

                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                </div>

                <div class="flex justify-between mx-3 mt-3 mb-2">

                    <button type="submit"
                            class="px-4 py-2 bg-gray-800 text-white rounded font-light hover:bg-gray-700">Add
                    </button>

                </div>
            </form>
        </div>
    </div>

    {{--all comments--}}
    @component('layouts.comments', ['comments' => $post->comments])
    @endcomponent

@endsection
