@extends('layout.dashboard')

@section('title')
    Kategori
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
        <form id="deleteKategori" action="" method="post">
            @csrf
            @method('delete')
            <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal" onClick="formSubmit()">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid mt-3">
    <h1 class="border-bottom">Kategory</h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('showCategory') }}" class="btn btn-primary text-white">Tambah Kategori</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Nama</th>        
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $data)
            <tr>
                <th scope="row">{{ $data->id }}</th>
                <td>{{ $data->name }}</td>
                <td>
                    <div class="d-flex">
                        <a href="/category/{{ $data->id }}/edit" class="btn btn-primary text-white me-3">Edit</a>
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
        let url = "/category/"+id;
        $('#deleteKategori').attr('action',url);
    }

    function formSubmit(){
        $('#deleteKategori').submit();
    }
</script>
@endsection