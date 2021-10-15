<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Sepeda</title>
    <!-- <script src="{{ asset('/js/app.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}"> -->
    <link rel="stylesheet" href="{{ asset('/css/style.css') }}">

</head>
<body>
    <div class="container" style="max-width: 768px">
        <h3 class="mt-3">Tambah Sepeda</h3>
            @if(session('errors'))
                <div class="alert alert-danger" role="alert">
                    Error : 
                    @foreach ($errors->all() as $error)
                        <p class="m-0"><i class="bi-exclamation-triangle"></i> {{ $error }}</p>
                    @endforeach
                </div>
            @endif
        <form action="/sepeda/add" method="post">
            @csrf
            <label for="">Nama sepeda</label>
            <input class="form-control" type="text" name="nama_sepeda">
            <label for="">Merk sepeda</label>
            <input class="form-control" type="text" name="merk_sepeda">
            <label for="">Jenis sepeda</label>
            <select name="jenis_sepeda" class="form-control">
                <option value="">Pilih Jenis</option>
                <option value="1">Sepeda Gunung</option>
                <option value="2">Sepeda Lipat</option>
            </select>
            <label for="">Peruntukan</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="peruntukan" id="flexRadioDefault1" value="laki-laki">
                <label class="form-check-label" for="flexRadioDefault1">
                   Laki-Laki
                </label>
                </div>
                <div class="form-check">
                <input class="form-check-input" type="radio" name="peruntukan" id="flexRadioDefault2" value="perempuan" >
                <label class="form-check-label" for="flexRadioDefault2">
                    Perempuan
                </label>
            </div>
            <div class="form-group"></div>
            <label for="">Jumlah speed</label>
            <input class="form-control" type="text" name="jumlah_speed">
            <label for="">Tanggal launching</label></br>
            <div class="form-group">
                <div class='input-group date' id='datetimepicker1'>
                <input type='text' class="form-control" name="tanggal_launching" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
                </div>
            </div>
            
            <button class="btn btn-primary text-white">Submit</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">

<script>
  $(function () {
    $('#datetimepicker1').datetimepicker();
 });
 </script>
</body>
</html>