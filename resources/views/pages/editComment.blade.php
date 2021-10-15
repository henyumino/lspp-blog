<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
    <script src="{{ asset('/js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
    <div class="container" style="max-width: 768px">
        <h3 class="mt-3">Edit Komentar</h3>
            @if(session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <p class="m-0"><i class="bi-exclamation-triangle"></i> {{ $error }}</p>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <form action="/comment/{{ $comm->id }}/edit" method="post">
            @csrf
            @method('put')
            <div class="form-floating">
                <textarea class="form-control" name="content" style="height: 100px">{{ $comm->content }}</textarea>
                <label for="floatingTextarea2">Komentar</label>
            </div>
            <div class="d-flex justify-content-end mt-2">
                <button type="submit" class="btn btn-primary text-white">Update</button>
            </div>
        </form>
    </div>
</body>
</html>