@extends('layouts.helloapp')

@section('head')
@parent
@endsection

@section('title','categoried')

@section('content')
<div class="categoried">
<p>カテゴリ追加が完了しました</p>
<p><a href="/category">カテゴリ一覧に戻る</a></p>
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
