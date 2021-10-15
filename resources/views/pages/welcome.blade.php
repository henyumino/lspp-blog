@extends('layout.app')

@section('title')
    Welcome
@endsection

@section('content')
    <div class="container my-5">


    @foreach($posts as $post)
        @if($loop->first)
            <div class="card mb-3 mb-4">
                <div class="row">
                    <div class="col-md-8">
                        <img src="{{ asset('/storage/thumbnail').'/'.$post->thumbnail }}" class="img-fluid w-100 rounded-start" alt="..." style="object-fit:fill;">
                    </div>
                    <div class="col-md-4">
                        <div class="card-body">
                            <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
                            <h3 class="card-title">{{ $post->title }}</h3>
                            <p class="card-text">{!! Str::limit(strip_tags($post->content), 100 ,'...') !!}</p>
                            @foreach($post->categories as $cat)
                                <span class="badge bg-primary">{{ $cat->name }}</span></h6>
                            @endforeach
                            <a href="/post/{{ $post->slug }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4" data-masonry='{"percentPosition": true }'>
            @else
                <div class="col">
                    <div class="card">
                        <img src="{{ asset('/storage/thumbnail').'/'.$post->thumbnail }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <p class="card-text"><small class="text-muted">{{ $post->created_at->diffForHumans() }}</small></p>
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p class="card-text">{{ strip_tags(Str::limit($post->content, 100 ,'...')) }}</p>
                            @foreach($post->categories as $cat)
                                <span class="badge bg-primary">{{ $cat->name }}</span></h6>
                            @endforeach
                            <a href="/post/{{ $post->slug }}" class="stretched-link"></a>
                        </div>
                    </div>
                </div>
            @endif
    @endforeach
            </div>

    </div>

@endsection