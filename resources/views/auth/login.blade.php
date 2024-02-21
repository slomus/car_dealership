@extends('layouts.auth')

@section('content')
<div class="container">
    <form method="post" action="{{ route('login.login') }}">
        @csrf
        
        <h1 class="h3 mb-3 fw-normal">Login</h1>

        @include('layouts.message')

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="floatingName" placeholder="Nazwa" autofocus>
            <label for="floatingName">Nazwa</label>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="floatingPassword" placeholder="Hasło">
            <label for="floatingPassword">Hasło</label>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Zaloguj się</button>
        
    </form>
</div>
@endsection
