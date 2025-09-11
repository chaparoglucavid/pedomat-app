@extends('layouts.app')
@section('content')
    <div class="auth-page">
        <div class="auth-card auth-card--auth">

            @if ($errors->any())
                <div class="alert alert-danger mb-3">Zəhmət olmasa formdakı xətaları düzəldin.</div>
            @endif

            <div class="auth-head">
                <h1 class="auth-title">Qeydiyyat</h1>
                <p class="auth-sub">Yeni hesab yaradın</p>
            </div>

            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <div class="mb-3">
                    <label for="name" class="form-label">Ad, Soyad</label>
                    <input id="name" type="text" name="full_name" value="{{ old('full_name') }}"
                           class="form-control @error('full_name') is-invalid @enderror"
                           required autocomplete="name" inputmode="text">
                    @error('full_name')
                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">E-poçt</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}"
                           class="form-control @error('email') is-invalid @enderror"
                           required autocomplete="email" inputmode="email">
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Şifrə</label>
                    <input id="password" type="password" name="password"
                           class="form-control @error('password') is-invalid @enderror"
                           required autocomplete="new-password">
                    @error('password')
                    <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>

                <div class="mb-2">
                    <label for="password_confirmation" class="form-label">Şifrənin təkrarı</label>
                    <input id="password_confirmation" type="password" name="password_confirmation"
                           class="form-control" required autocomplete="new-password">
                </div>

                <div class="auth-actions">
                    <button type="submit" class="btn btn-primary auth-btn">Qeydiyyatdan keç</button>
                </div>
            </form>

            <div class="auth-sep"><span>və ya</span></div>

            <div class="auth-foot">
                <span class="text-muted">Artıq hesabınız var?</span>
                <a class="auth-link" href="{{ route('login') }}">Giriş</a>
            </div>
        </div>
    </div>

@endsection
