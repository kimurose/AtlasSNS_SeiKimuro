<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
    <!--IEブラウザ対策-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="description" content="ページの内容を表す文章" />
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }} ">
    <link rel="stylesheet" href="{{ asset('css/style.css') }} ">
    <!--スマホ,タブレット対応-->
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <!--サイトのアイコン指定-->
    <link rel="icon" href="画像URL" sizes="16x16" type="image/png" />
    <link rel="icon" href="画像URL" sizes="32x32" type="image/png" />
    <link rel="icon" href="画像URL" sizes="48x48" type="image/png" />
    <link rel="icon" href="画像URL" sizes="62x62" type="image/png" />
    <!--iphoneのアプリアイコン指定-->
    <link rel="apple-touch-icon-precomposed" href="画像のURL" />
    <!--OGPタグ/twitterカード-->
</head>
<body>
    <header>
        <div id = "head">
        <h1><a href="/top"><img src="/images/atlas.png" alt="Logo"></a></h1>
            <div id="content">
                <div id="user-info">
                    <p>{{ Auth::user()->username }}　さん　　<span class="arrow-down" id="toggle-menu"></span></p>
                    <img src="{{ asset('images/' . (Auth::user()->images ?? 'icon1.png')) }}" alt="User Icon" style="width: 50px; height: 50px;">
                </div>
                <div id="accordion-menu" class="hidden">
                    <ul>
                        <li><a href="/top">HOME</a></li>
                        <li class="accordion-profile"><a href="/profile">プロフィール編集</a></li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit">ログアウト</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- <form id="logout-form" action="{{-- route('logout') --}}" method="POST">
            @csrf
        </form> -->
    </header>
    <div id="row">
        <div id="container">
            @yield('content')
        </div >
        <div id="side-bar">
            <div id="confirm">
                <p class="login-username">{{ Auth::user()->username }}さんの</p>
                <div class="follow-info">
                    <p>フォロー数</p>
                    <p>{{ \App\Follow::where('following_id', Auth::id())->count() }}名</p>
                </div>
                <p class="follow-info-btn"><a href="{{ url('/followList') }}">フォローリスト</a></p>
                <div class="follow-info">
                    <p>フォロワー数</p>
                    <p>{{ \App\Follow::where('followed_id', Auth::id())->count() }}名</p>
                </div>
                <p class="follower-info-btn"><a href="{{ url('/followerList') }}">フォロワーリスト</a></p>
            </div>
            <p class="search-btn"><a href="{{ url('/search') }}">ユーザー検索</a></p>
        </div>
    </div>
    <footer>
    </footer>
    <!-- <script src="JavaScriptファイルのURL"></script> -->
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
