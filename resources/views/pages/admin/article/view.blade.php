@extends('layout.layout')

@section('title', 'Article')

@section('content')

    <div class="container">
        <div class="card mt-5">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>{{ $article->title }}</h3>
                <button class="border p-2 rounded text-bg-light shadow-sm btn p-0"
                    onclick="window.location.href='{{ route('admin.articles.index') }}';" style="min-width: max-content">
                    <span class="me-2">{{ $article->user->full_name }}</span>
                    <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                        alt="" class="rounded-circle" width="50">
                </button>
            </div>
            <div class="card-body">
                <p>{!! $article->content !!}</p>
            </div>
            @if ($article->comments->first())
                <div class="card-footer">
                    <h3 class="mt-2 mb-3 ms-2">Comments:</h3>
                    <div class="w-75 d-flex flex-column">
                        {{-- <div class="card mb-2 d-inline-flex flex-row rounded-5 w-100">
                            <div class="card-header border border-0 rounded-end rounded-5 d-flex">
                                <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                alt="" class="rounded-circle my-auto" width="50">
                            </div>
                            <div class="card-body">
                                <a class="text-dark" href="{{ route('admin.articles.index') }}">
                                    <span class="me-2">{{ Auth::user()->full_name }}</span>
                                </a>
                                <form action="{{ route('articles.comments.create', $article) }}" method="post">
                                    <div class="input-group mt-2 mb-1">
                                        @csrf
                                        <textarea class="form-control" name="content" placeholder="write your comment here..."
                                        aria-label="write your comment here..." aria-describedby="submit"></textarea>
                                        <button class="btn btn-outline-primary" type="submit" id="submit">submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div> --}}

                        @foreach ($article->comments as $comment)
                            <div class="card mb-2 d-inline-flex flex-row rounded-5" style="max-width: fit-content">
                                {{-- the header (user photo) --}}
                                <div class="card-header border border-0 rounded-end rounded-5 d-flex">
                                    <button class="btn p-0 my-auto"
                                        onclick="window.location.href='{{ route('admin.articles.index') }}';">
                                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                                            alt="" class="rounded-circle" width="50">
                                    </button>
                                </div>
                                {{-- the content of the comment --}}
                                <div class="card-body">
                                    <a class="text-dark" href="{{ route('admin.articles.index') }}">
                                        <span class="me-2">{{ $comment->user->full_name }}</span>
                                    </a>
                                    <p class="mb-1 d-block" id="comment-{{ $comment->id }}-content">{{ $comment->content }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>

@endsection
