<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css2/stylesheet.css') }}" rel="stylesheet">
</head>
<body>
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
    <div id="app">
        <nav>
            <div class="conts">
                <button type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div id="navbarSupportedContent">
                    <ul>
                        <!-- Authentication Links -->
                        @guest
                            <li>
                                <a href="{{ route('login') }}">ログイン</a>
                            </li>
                            @if (Route::has('register'))
                                <li>
                                    <a class="nav-link" href="{{ route('register') }}">登録</a>
                                </li>
                            @endif
                        @else
                            <li>
                                <a id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        ログアウト
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>
