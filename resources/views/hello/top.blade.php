@extends('layouts.helloapp')

@section('head')
@parent
@endsection

@section('title','TOP')

@section('content')
<div class="container">
   <div class="content">
    <h1><a href="/question_all">質問一覧</a></h1>
   </div>
   <div class="content">
     <h1><a href="/question_form">質問投稿</form></h1>
   </div>
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
