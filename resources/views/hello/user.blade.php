@extends('layouts.helloapp')

@section('head')
@parent
@endsection

@section('title','user')

@section('content')
<div class="user">
  @if(Auth::check())
  <h1>ユーザーネーム</h1>
  @auth
  <div class="user_data">
   <p>{{Auth::user()->name}}</p>
  </div>
  @endauth
  <h1>メールアドレス</h1>
  @auth
  <div class="user_data">
    <p>{{Auth::user()->email}}</p>
  </div>
  @endauth
  <h1>所持ポイント</h1>
  <div class="user_data">
  <p>{{$point}}</p>
  </div>
  <h1>ランク</h1>
  <div class="user_data">
  @if($point < 50)
  <p>ブロンズ</p>
  @elseif($point < 100)
  <p>シルバー</p>
  @elseif($point < 200)
  <p>ゴールド</p>
  @elseif($point < 350)
  <p>プラチナ</p>
  @endif
  </div>
  <p><a href="/password/reset">パスワードを変更</a></p>
  @else
  <p><a href="/login">ログインしてユーザー情報を表示</a></p>
  <p><a href="/register">会員登録がまだな方はこちらで登録</a></p>
  @endif
  <div class="to_back">
  <P><a href="/top" id="back">戻る</a></p>
  </div>
</div>
@endsection

@section('footer')
<footer>
<h1>ランキング</h1>
<?php $n=1; ?>
<div class="footers">
@foreach($top as $to)
<div class="foot_ranking">
<P><a href="/question_all/qa?id={{$to->id}}">{{$n}}:{{$to->title}}</a></p>
</div>
<?php $n++ ?>
@endforeach
</div>
<p><a href="/ranking">もっと見る</a></p>
</footer>
@endsection
