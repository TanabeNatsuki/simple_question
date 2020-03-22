@extends('layouts.helloapp')

@section('title','category')

@section('head')
@parent
@endsection

@section('content')
<div class="container">
<div class="category">
<h1>カテゴリ一覧</h1>
@foreach($items as $item)
  <p><a href="category/all?id={{$item->id}}">{{$item->name}}</a></p>
@endforeach
<div class="category_add_link">
<p><a href="/category_add">カテゴリ追加</a></p>
</div>
<div class="to_back">
<P><a href="/" id="back">戻る</a></p>
  <script>
  back();
  </script>
</div>
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
