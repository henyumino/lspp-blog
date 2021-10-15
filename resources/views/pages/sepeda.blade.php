@extends('layout.dashboard')

@section('title')
    Sepeda
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
        <form id="deleteSepeda" action="" method="post">
            @csrf
            @method('delete')
            <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal" onClick="formSubmit()">Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="container-fluid mt-3">
    <h1 class="border-bottom">Sepeda</h1>
    <div class="d-flex justify-content-end">
        <a href="{{ route('addSepeda') }}" class="btn btn-primary text-white">Tambah Sepeda</a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Kode sepeda</th>
                <th scope="col">Nama Sepeda</th>        
                <th scope="col">Merek Sepeda</th>
                <th scope="col">Jenis Sepeda</th>
                <th scope="col">Peruntukan</th>
                <th scope="col">Jumlah speed</th>
                <th scope="col">Tanggal launching</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($data as $data)
            <tr>
                <th scope="row">{{ $data->id }}</th>
                <td>{{ $data->nama_sepeda }}</td>
                <td>{{ $data->merk_sepeda }}</td>
                <td>
                @switch($data->jenis_sepeda)
                    @case(1)
                        Sepeda Gunung
                        @break

                    @case(2)
                        Sepeda Lipat
                        @break

                    @default
                        
                @endswitch
                </td>
                <td>{{ $data->peruntukan }}</td>
                <td>{{ $data->jumlah_speed }}</td>
                <td>{{ $data->tanggal_launching }}</td>
                <td>
                    <div class="d-flex">
                        <a href="/sepeda/{{ $data->id }}/edit" class="btn btn-primary text-white">Edit</a>
                        <a class="btn btn-danger text-white" data-bs-toggle="modal" data-bs-target="#deleteModal" onClick="deleteId({{ $data->id }})">Hapus</a>
                    </div>
                </td>
            </tr>
           @endforeach
        </tbody>
    </table>
    
</div>

<script>
    function deleteId(id){
        let url = "/sepeda/"+id;
        $('#deleteSepeda').attr('action',url);
    }

    function formSubmit(){
        $('#deleteSepeda').submit();
    }
</script>
@endsection