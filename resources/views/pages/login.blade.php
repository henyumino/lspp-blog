@extends('layout.app')

@section('title')
    Login
@endsection

@section('flash')

    @if (session()->has('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

@endsection

@section('content')
<div class="container">
    <div class="auth-wrapper">
        <h1 class="text-center">Login</h1>
        <form method="post" action="{{ route('login') }}">
            @if(session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    @foreach ($errors->all() as $error)
                        <p class="m-0"><i class="bi-exclamation-triangle"></i> {{ $error }}</p>
                    @endforeach
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session()->has('gagal'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('gagal') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @csrf
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
            </div>
          
            <button type="submit" class="btn btn-primary w-100 text-light">Login</button>
            <div class="d-flex justify-content-center m-2">
                <a class="text-link" href="{{ route('register') }}">Tidak memiliki akun? daftar sekarang</a>
            </div>
        </form>
    </div>
    
</div>
@endsection