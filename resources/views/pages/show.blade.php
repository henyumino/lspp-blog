@extends('layout.app')

@section('title')
    Post - {{$post->title}}
@endsection

@section('flash')
    @if(session()->has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
@endsection

@section('content')
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Peringatan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Yakin menghapus Komentar ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form id="deleteCom" action="" method="post">
            @csrf
            @method('delete')
            <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal" onClick="formSubmit()">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
    <div class="container mt-5">
        <h1 class="text-center">{{ $post->title }}</h1>
        <div class="thumbnail-wrapper" style="background-image: url({{ asset('/storage/thumbnail').'/'.$post->thumbnail }})"></div>
        <p class="text-end m-0 text-muted">{{ $post->created_at->diffForHumans() }}</p>
        <p class="text-end ">{{ $post->user->name }}</p>
        <div class="content m-auto mb-5" style="max-width: 768px">
            {!! $post->content !!}
            <hr>
            @auth
                <form action="/comment/{{ $post->id }}" method="post">
                    @csrf
                    <div class="form-floating">
                        <textarea class="form-control" name="content" style="height: 100px"></textarea>
                        <label for="floatingTextarea2">Komentar</label>
                    </div>
                    <div class="d-flex justify-content-end mt-2">
                        <button type="submit" class="btn btn-primary text-white">Submit</button>
                    </div>
                </form>
            @endauth

            @foreach($post->comments->reverse() as $comment)
            <div class="card bg-light my-2 border-light" style="width: 100%;">
                <div class="card-body">
                    <h5 class="card-title d-flex justify-content-between">
                        {{ $comment->user->name }}
                        @if(Auth::user()->id === $comment->user->id)
                            <i class="bi-three-dots-vertical" data-bs-toggle="dropdown"></i>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="/comment/{{ $comment->id }}/edit">Edit</a></li>
                                <li><a class="dropdown-item text-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onClick="deleteId({{ $comment->id }})">Delete</a></li>
                            </ul>
                        @endif
                    </h5>
                    <h6 class="card-subtitle mb-2 text-muted">{{ $comment->created_at->diffForHumans() }}</h6>
                    <p class="card-text">{{ $comment->content }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>

<script>
    function deleteId(id){
        let url = "/comment/"+id;
        $('#deleteCom').attr('action',url);
    }

    function formSubmit(){
        $('#deleteCom').submit();
    }
</script>
@endsection