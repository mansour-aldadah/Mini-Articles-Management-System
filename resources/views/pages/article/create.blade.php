@extends('layout.layout')

@section('title', 'Article | create')

@section('content')

    <div class="container pt-5">
        <h1>Create Article</h1>

        <form action="{{ route('articles.store') }}" method="post">
            @csrf
            <div class="card mt-5">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="w-75">
                        <label class="w-100">
                            Article Title
                            <input class="form-control w-100" name="title" placeholder="Article Title">
                        </label>
                    </div>
                    <button class="border p-2 rounded text-bg-light shadow-sm btn p-0"
                        onclick="window.location.href='{{ route('articles.index') }}';" style="min-width: max-content">
                        <span class="me-2">{{ auth()->user()->full_name }}</span>
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                            alt="" class="rounded-circle" width="50">
                    </button>
                </div>
                <div class="card-body">
                    <label class="w-100">
                        <textarea name="content" id="content" class="form-control w-100" rows="16"
                            placeholder="wirte here the article..."></textarea>
                    </label>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Send to review</button>
                </div>
            </div>
        </form>
    </div>

@endsection
