@extends('layouts.app')

@section('content')

    <div class="page__header">
        <h1 class="page__title">Giriş</h1>
        <p class="page__sub">Hesabınıza daxil olun</p>
    </div>
    <div class="auth-card">
        {{-- Status / ümumi error --}}
        @if (session('status'))
            <div class="alert alert-success mb-3">{{ session('status') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                Zəhmət olmasa formdakı xətaları düzəldin.
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">E-poçt</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       required autofocus autocomplete="username">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Şifrə</label>
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required autocomplete="current-password">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="auth-actions">
                <button type="submit" class="btn btn-sm btn-primary w-100">Daxil olun</button>
                <br>
                <br>
                <a class="text-decoration-none d-flex justify-content-end" href="{{ route('password.request') }}"><small>Şifrəni unutmusunuz?</small></a>
            </div>
        </form>

        <hr class="my-3">
        <div class="d-flex gap-2">
            <span class="text-muted">Hesabınız yoxdur?</span>
            <a class="text-decoration-none" href="{{ route('register') }}">Qeydiyyatdan keçin</a>
        </div>
    </div>
@endsection
