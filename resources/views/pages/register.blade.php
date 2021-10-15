@extends('layout.app')

@section('title')
    Register
@endsection

@section('content')
<div class="container">
    
    <div class="auth-wrapper">
        <h1 class="text-center">Register</h1>
        <form method="post" action="{{ route('register') }}">
            @if(session('errors'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    Something it's wrong:
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif

            @if (session()->has('errors'))
                <div class="alert alert-danger">
                    {{ Session::get('errors') }}
                </div>
            @endif

            @csrf
            <div class="mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('name')}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{old('email')}}">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password Confirmation</label>
                <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword1">
            </div>
          
            <button type="submit" class="btn btn-primary w-100 text-light">Register</button>
        </form>
    </div>
    
</div>
@endsection