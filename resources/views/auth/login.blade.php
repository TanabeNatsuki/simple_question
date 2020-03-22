@extends('layouts.app')

@section('content')
 <div class="cont">
  <h1>ログイン</h1>
  <form method="POST" action="{{ route('login') }}">
    @csrf
    <label for="email" class="col-md-4 col-form-label text-md-right">Eメールアドレス</label>
    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus><br>

    @error('email')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror

    <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>

    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"><br>

    @error('password')
      <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
      </span>
    @enderror

    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

    <label class="form-check-label" for="remember">ログインを保持</label>

    <button type="submit" class="btn btn-primary">ログイン</button>

    @if (Route::has('password.request'))
      <a class="btn btn-link" href="{{ route('password.request') }}">パスワードをお忘れですか？</a>
    @endif
  </form>
</div>
@endsection
