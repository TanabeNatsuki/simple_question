<html>
@section('head')
<head>
  <title>@yield('title')</title>
  <link rel="stylesheet" href="{{ asset('css2/stylesheet.css')}}">
  <script src="{{ asset('js/script.js')}}" type="text/javascript"></script>
</head>
@show
<body>
<div class="wrapper">
<header>
  <table>
    <tr>
      <th><div class="set"><a href="/register">会員登録</a></div></th>
      <th><div class="login"><a href="/login">ログイン</a></div></th>
      <th><a href="/top"><img src="{{ asset('image/logo.gif') }}" align="right" alt="logo"></a></th>
      <form action="search" method="post">
       @csrf
       <th><input type="text" name="search"></th>
       <th><input type="submit" value="検索"></th>
     </form>
        <th>
          <div class="usericon">
            <a href="/user">
              <img src="{{ asset('image/')}}" alt="userimage">
            </a>
          </div>
        </th>
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
<div class="contents">
  @yield('content')
</div>
</main>

<div class="footer">
@yield('footer')
</div>
</div>
</body>
</html>
