<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Post</title>
    <script src="{{ asset('/js/app.js') }}"></script>
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">
</head>
<body>
    <div class="container" style="max-width: 768px;">
        <form id="form-post" action="{{ route('storePost') }}" method="post" enctype="multipart/form-data">
            @csrf
            <h3 class="mt-4">Judul</h3>

            <input class="form-control my-4" type="text" name="title" value="{{ old('title') }}">

            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            
            <div id="editor"></div>
            @error('content')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <input type="hidden" name="content" id="content">
            @error('thumbnail')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <input class="form-control mt-3" type="file" name="thumbnail">
            <select class="form-select mt-3" name="category">
                <option value="">None</option>
                @foreach($cat as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
        </form>
        <div class="w-100 d-flex justify-content-end mt-2">
            <button class="btn btn-primary text-white" id="btn-submit">Post</button>
        </div>
        <a href="{{ route('dashboard') }}">Kembali dashboard</a>
    </div>

<script src="{{ asset('/js/quill.js') }}"></script>
<script src="{{ asset('/js/image-resize.js') }}"></script>
<script>
    
    var toolbarOptions = [
        [{ 'header': [1, 2, 3, false] }], 
        ['bold', 'italic','underline'], 
        ['link', 'image']
    ];
    var quill = new Quill('#editor', {
        theme: 'snow',
        modules: {
            toolbar: toolbarOptions,
            imageResize : {
                modules: [ 'Resize', 'DisplaySize', 'Toolbar' ]
            }
        }
    });

    $('#btn-submit').on('click', () => { 
    
        var html = quill.root.innerHTML;

        $('#content').val(html)

        $('#form-post').submit();
    });
</script>
</body>
</html>