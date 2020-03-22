@extends('layouts.app')

@section('head')
@parent
@endsection

@section('title','reset_pass')

@section('content')
<div class="cont">
@if($users==null)
<p>登録されていないメールアドレスです</p>
<div class="to_back">
<P><a href="/" id="back">戻る</a></p>
  <script>
  back();
  </script>
</div>
@else
<form method="post" action="reseted">
  @csrf
  <label>パスワード（新規）<input type="text" name="new_pass"></label><br>
  @error('email')
  <div class="error">
  <p>{{$message}}</p>
  </div>
  @enderror
  <input type="text" value="{{$users->email}}" name="email">
  <input type="submit" value="送信">
</form>
</div>
@endif
@endsection
