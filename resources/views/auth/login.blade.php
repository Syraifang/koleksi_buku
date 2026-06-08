@extends('layouts.master') {{-- Pastikan ini mengarah ke layout master Purple Admin kamu --}}

@section('content')
<div class="content-wrapper d-flex align-items-center auth">
  <div class="row flex-grow">
    <div class="col-lg-4 mx-auto">
      <div class="auth-form-light text-left p-5">
        <div class="brand-logo">
          <img src="{{ asset('assets/images/logo.svg') }}">
        </div>
        <h4>Halo! Mari kita mulai</h4>
        <h6 class="font-weight-light">Masuk untuk melanjutkan ke Koleksi Buku.</h6>
        
        <form class="pt-3" method="POST" action="{{ route('login') }}">
          @csrf
          <div class="form-group">
            <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email Address" required>
          </div>
          <div class="form-group">
            <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" required>
          </div>
          <div class="mt-3">
            <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">MASUK</button>
          </div>
          
          <div class="text-center mt-4 font-weight-light"> Atau masuk dengan </div>
          
          <div class="mt-3">
            <a href="{{ route('google.login') }}" class="btn btn-block btn-danger btn-lg font-weight-medium auth-form-btn">
              <i class="mdi mdi-google mr-2"></i> Login with Google
            </a>
          </div>

          <div class="text-center mt-4 font-weight-light"> Belum punya akun? <a href="{{ route('register') }}" class="text-primary">Daftar</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection