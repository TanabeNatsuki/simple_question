@extends('layouts.helloapp')

@section('title','ranking')

@section('head')
@parent
@endsection

@section('content')
<div class="container">
<div class="ranking">
 <h1>ランキング</h1>
 <?php $n=1; ?>
 @foreach($top as $to)
 <div class="foot_ranking">
 <P><a href="/question_all/qa?id={{$to->id}}">{{$n}}:{{$to->title}}</a></p>
 </div>
 <?php $n++ ?>
 @endforeach
 {{$top->links()}}
 </div>
 <div class="to_back">
 <P><a href="/" id="back">戻る</a></p>
   <script>
   back();
   </script>
 </div>
</div>
@endsection
