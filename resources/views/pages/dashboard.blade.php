@extends('layout.dashboard')

@section('title')
    Post
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
        Yakin menghapus kategori ini?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form id="deletePost" action="" method="post">
            @csrf
            @method('delete')
            <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal" onClick="formSubmit()">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt-3">
    <h1 class="border-bottom">Post</h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('addpost') }}" class="btn btn-primary text-white">Tambah Post</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Judul</th>
                <th scope="col">Kategori</th>
                <th scope="col">Tanggal</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $data)
            <tr>
                <th scope="row">{{ $data->id }}</th>
                <td>{{ $data->title }}</td>
                @foreach($data->categories as $cat)
                    <td>{{$cat->name}}</td> 
                @endforeach
                <td>{{ $data->created_at }}</td>
                <td>
                    <div class="d-flex">
                        <a href="/post/{{ $data->id }}/edit" class="btn btn-primary text-white me-3">Edit</a>
                        <a href="" class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal" onClick="deleteId({{ $data->id }})">Delete</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
</div>


<script>

    function deleteId(id){
        let url = "/post/"+id;
        $('#deletePost').attr('action',url);
    }

    function formSubmit(){
        $('#deletePost').submit();
    }
</script>

@endsection