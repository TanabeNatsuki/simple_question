<html>
@section('head')
<head>
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css2/stylesheet.css')}}">
  <script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
@show
<body>
<div class="wrapper">
<header>
  <table>
    <tr>
      <th><div class="set"><a href="/register">会員登録</a></div></th>
      <th><div class="login"><a href="/login">ログイン</a></div></th>
      <th><div class="titlelogo"><a href="/top">GameQ</a></div></th>
    <form action="/search" method="post">
       @csrf
       <th><input type="text" name="search"></th>
       <th><input type="submit" value="検索"></th>
     </form>
       @if(Auth::check())
        <th>
          <div class="usericon">
            <a href="/user">
              <p>ユーザーページ</p>
            </a>
          </div>
        </th>
        @endif
   </tr>
 </table>
</header>
<div class="nav">
  <ul>
    <li><a href="/top">Top</a></li>
    <li><a href="/category">カテゴリ</a></li>
    <li><a href="/ranking">ランキング</a></li>
  </ul>
</div>

<main>
 <div class="newpage">
  <div class="new_content">
    <p>新着記事</p>
  </div>
  @foreach($new as $re)
  <div class="side">
    <P><a href="/question_all/qa?id={{$re->id}}">{{$re->title}}</a></p>
    <div class="side_day">
      <p>投稿日時{{$re->created_at}}</p>
    </div>
  </div>
  @endforeach
  <div class="new_con">
    <p><a href="/question_all">もっと見る</a></p>
  </div>
 </div>

  <div class="main">
    @yield('content')
  </div>
</main>
</div>

<div class="footer">
@yield('footer')
</div>
</div>
</body>
</html>
