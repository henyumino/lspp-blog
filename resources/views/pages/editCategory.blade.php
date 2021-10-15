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
        <h3 class="mt-3">Tambah Kategori</h3>
            @if(session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <p class="m-0"><i class="bi-exclamation-triangle"></i> {{ $error }}</p>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        <form action="/category/{{ $data->id }}/edit" method="post">
            @csrf
            @method('put')
            <input class="form-control my-3" type="text" name="category" value="{{ $data->name }}">
            <button class="btn btn-primary text-white">Submit</button>
        </form>
    </div>
</body>
</html>