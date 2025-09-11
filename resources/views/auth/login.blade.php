@extends('layouts.app')

@section('content')

    <div class="auth-page">
        <div class="auth-card auth-card--auth">

            {{-- Status / ümumi error --}}
            @if (session('status'))
                <div class="alert alert-success mb-3">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger mb-3">Zəhmət olmasa formdakı xətaları düzəldin.</div>
            @endif

            <div class="auth-head">
                <h1 class="auth-title">Giriş</h1>
                <p class="auth-sub">Hesabınıza daxil olun</p>
            </div>

            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label">E-poçt</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           required autofocus autocomplete="username" inputmode="email">
                    @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-2">
                    <label for="password" class="form-label">Şifrə</label>
                    <input id="password" type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required autocomplete="current-password">
                    @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="auth-aux">
                    <a class="auth-link" href="{{ route('password.request') }}">Şifrəni unutmusunuz?</a>
                </div>

                <div class="auth-actions">
                    <button type="submit" class="btn btn-primary auth-btn">Daxil olun</button>
                </div>
            </form>

            <div class="auth-sep"><span>və ya</span></div>

            <div class="auth-foot">
                <span class="text-muted">Hesabınız yoxdur?</span>
                <a class="auth-link" href="{{ route('register') }}">Qeydiyyatdan keçin</a>
            </div>
        </div>
    </div>

@endsection
