@extends('blog::layouts.master')

@section('title', 'Category '. $category->title)

@section('content')
<div class="w-4/5 m-auto text-left mt-10">
    <a href="#"
       class="flex flex-col items-center bg-white rounded-lg border shadow-md md:flex-row md:max-w-xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
        <img class="object-cover w-full h-96 rounded-t-lg md:h-auto md:w-48 md:rounded-none md:rounded-l-lg"
             src="{{ categoryStorageFilePath($category->image_path) }}" alt="">
        <div class="flex flex-col justify-between p-4 leading-normal">
            <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $category->title }}</h5>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">{{ $category->description }}</p>
        </div>
    </a>
</div>


@endsection
