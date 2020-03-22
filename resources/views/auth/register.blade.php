@extends('layouts.app')

@section('content')
<div class="cont">
  <h1>会員登録</h1>
     <form method="POST" action="/registered">
        @csrf
        <label for="name" class="col-md-4 col-form-label text-md-right">名前</label>
          <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus><br>
            @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
            @enderror
            <label for="email" class="col-md-4 col-form-label text-md-right">Eメールアドレス</label>
            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"><br>
            @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
            <label for="password" class="col-md-4 col-form-label text-md-right">パスワード</label>
            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"><br>

            @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
            @enderror
            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">パスワード（確認）</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"><br>

            <button type="submit" class="btn btn-primary">登録</button>
            </form>
          </div>
@endsection
