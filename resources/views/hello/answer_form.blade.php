@extends('layouts.helloapp')

@section('head')
@parent
@endsection

@section('title','answer_form')

@section('content')
<div class="container">
  <h1>回答投稿フォーム</h1>
  <form action="/answer_complete" method="post">
    @csrf
    <textarea name="content" cols="30" rows="50"></textarea><br>
    <input type="hidden" name="user_id" value="{{$user_id}}">
    <input type="hidden" name="question_id" value="{{$question_id}}">
    <input type="submit" value="回答する">
  </form>
  <div class="to_back">
  <P><a href="/top" id="back">戻る</a></p>
    <script>
    back();
    </script>
  </div>
</div>
@endsection
