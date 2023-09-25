@extends('layout.layout')

@section('title', 'Article')

@section('content')
    <div class="container pt-5">

        <h1>Manage Articles</h1>
        @foreach ($articles as $article)
            <div class="card my-3 shadow">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div>
                        <h3>{{ $article->title }}</h3>
                        <span>{{ $article->comments_count }} comments • </span>
                        <span>{{ $article->published_at?->diffForHumans() ?? ($article->created_at->diffForHumans() ?? '') }}
                            • </span>
                        <span>{{ \Str::replace('_', ' ', $article->status) }}</span>
                    </div>
                    <button class="border p-2 rounded text-bg-light shadow-sm btn p-0" style="min-width: max-content"
                        onclick="window.location.href='{{ route('admin.articles.index') }}';">
                        <span class="me-2">{{ $article->user->full_name }}</span>
                        <img src="https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_960_720.png"
                            alt="" class="rounded-circle" width="50">
                    </button>
                </div>
                <div class="card-body">
                    <p>{!! $article->content !!}</p>
                    <div class="d-flex">
                        <a href="{{ route('admin.articles.show', $article->slug) }}" class="btn btn-primary">View</a>
                        <form action="{{ route('admin.articles.change_status', [$article, 'approve']) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="ms-2 btn btn-success">approve</button>
                        </form>
                        <form action="{{ route('admin.articles.change_status', [$article, 'reject']) }}" method="post">
                            @csrf
                            @method('PUT')
                            <button class="ms-2 btn btn-danger">reject</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        {!! $articles->links() !!}

    </div>
@endsection
