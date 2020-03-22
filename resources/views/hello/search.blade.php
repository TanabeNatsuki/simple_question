@extends('layouts.helloapp')

@section('head')
@parent
@endsection

@section('title','question_get')

@section('content')
<div class="container">
  <h1>検索結果</h1>
  @foreach($searchs as $search)
  <div class="search_data">
  <p>タイトル:{{$search->title}}</p>
  <div class="created">
    <p>投稿日: {{$search->created_at}}</p>
  </div>
  </div>
  @endforeach
  <div class="to_back">
  <P><a href="/" id="back">戻る</a></p>
    <script>
    back();
    </script>
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
