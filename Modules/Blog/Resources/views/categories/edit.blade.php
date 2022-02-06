@extends('blog::layouts.master')

@section('title', 'Edit '. $category->title)

@section('content')
    <div class="w-4/5 m-auto text-left">
        <div class="py-15">
            <h1 class="text-6xl">
                Update {{ $category->title }}
            </h1>
        </div>
    </div>

    @if($errors->any())
        <div class="w-4/5 m-auto">
            <ul>
                @foreach($errors->all() as $error)
                    <li class="w-1/5 mb-4 text-gray-50 bg-red-700 rounded-2xl py-4">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="w-4/5 m-auto pt-20">
        <form
            action="{{ route('blog.categories.update', ['category' => $category->slug]) }}"
            method="post"
            enctype="multipart/form-data">
            @csrf
            @method('put')

            <input
                type="text"
                name="title"
                value="{{$category->title}}"
                class="bg-transparent block border-b-2 w-full h-20 text-6xl outline-none">

            <textarea
                name="description"
                placeholder="Description..."
                class="py-20 bg-transparent block border-b-2 w-full h-60 text-xl outline-none">
                {{$category->description}}
            </textarea>

            @include('blog::layouts.upload-file')

            <button
                type="submit"
                class="mt-10 uppercase bg-blue-500 text-gray-100 text-lg font-extrabold py-4 px-8 rounded-3xl">
                Update category
            </button>

        </form>
    </div>


@endsection
