@extends('layouts.app')
@section('content')
    <div class="page__header">
        <h1 class="page__title">Qeydiyyat</h1>
        <p class="page__sub">Yeni hesab yaradın</p>
    </div>

    <div class="auth-card">
        @if ($errors->any())
            <div class="alert alert-danger mb-3">
                Zəhmət olmasa formdakı xətaları düzəldin.
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}" novalidate>
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Ad, Soyad</label>
                <input id="name" type="text" name="full_name" value="{{ old('full_name') }}"
                       class="form-control @error('full_name') is-invalid @enderror"
                       required autocomplete="name">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-poçt</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       class="form-control @error('email') is-invalid @enderror"
                       required autocomplete="email">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Şifrə</label>
                <input id="password" type="password" name="password"
                       class="form-control @error('password') is-invalid @enderror"
                       required autocomplete="new-password">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Şifrənin təkrarı</label>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       class="form-control" required autocomplete="new-password">
            </div>

            <button type="submit" class="btn btn-primary w-100">Qeydiyyatdan keç</button>
        </form>

        <hr class="my-3">
        <div class="d-flex gap-2">
            <span class="text-muted">Artıq hesabınız var?</span>
            <a class="text-decoration-none" href="{{ route('login') }}">Giriş</a>
        </div>
    </div>
@endsection
