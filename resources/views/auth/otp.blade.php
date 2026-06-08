@extends('layouts.master')

@section('content')
<div class="content-wrapper d-flex align-items-center auth">
  <div class="row flex-grow">
    <div class="col-lg-4 mx-auto">
      <div class="auth-form-light text-left p-5">
        <div class="brand-logo">
          <img src="{{ asset('assets/images/logo.svg') }}" alt="logo">
        </div>
        <h4>Verifikasi Keamanan</h4>
        <h6 class="font-weight-light">Kode OTP telah dikirim ke email kamu (cek database untuk pengujian).</h6>
        
        <form class="pt-3" method="POST" action="{{ route('otp.verify') }}">
          @csrf
          <div class="form-group">
            <input type="text" name="otp" class="form-control form-control-lg @error('otp') is-invalid @enderror" placeholder="Masukkan 6 Digit OTP" maxlength="6" required autofocus autocomplete="off">
            
            @error('otp')
                <span class="text-danger mt-2 d-block text-sm">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
          </div>
          
          <div class="mt-3 d-grid gap-2">
            <button type="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">VERIFIKASI SEKARANG</button>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>
@endsection