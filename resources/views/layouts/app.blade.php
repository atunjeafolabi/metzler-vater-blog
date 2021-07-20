<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title")</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link rel="stylesheet" href="/css/vendor/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="/css/vendor/animate.css">
    <link rel="stylesheet" href="/css/vendor/aos.css">
    <link rel="stylesheet" href="/css/vendor/ionicons.min.css">
    <link rel="stylesheet" href="/css/vendor/icomoon.css">
    <link rel="stylesheet" href="/css/vendor/style.css">
    <link href="/css/custom.css" rel="stylesheet">
</head>
<body>
    <div id="app">
        <loader></loader>
    </div>
    <main>
        <div id="colorlib-page">
            <a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
            <aside id="colorlib-aside" role="complementary" class="js-fullheight">
                <h4>Metzler Vater Blog</h4>
                <nav id="colorlib-main-menu" role="navigation">
                    <ul class="mt-4">
                        <!-- Authentication Links -->
                        @guest
                            <li>
                                <a href="{{ route('login') }}">{{ __('Login') }}</a>
                                @if (Route::has('register'))
                                    | <a href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            </li>
                        @else
                            <span>Welcome, {{ Auth::user()->name }}</span>

                            <a href="{{ route('logout') }}"
                               id="logout-link"
                               onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        @endguest
                    </ul>
                    <ul class="mt-3">
                        <li class="border-top border-bottom"><strong>Posts</strong></li>
                        <li class="colorlib-active"><a href="{{route('index')}}">All</a></li>
                        @auth
                            <li><a href="{{route('create-form')}}" class="add-new-post">Add</a></li>
                            <li class="border-top border-bottom"><strong>Users</strong></li>
                            <li><a href="{{route('users')}}" class="users">All</a></li>
                            <li><a href="{{route('create-user-form')}}">Add</a></li>
                        @endauth
                    </ul>
                </nav>
            </aside>
            <div id="colorlib-main">
                <section class="ftco-section ftco-no-pt ftco-no-pb">
                    <div class="container">
                        <div class="row d-flex">
                            @yield('content')
                            <div class="col-xl-4 sidebar ftco-animate bg-light pt-5">
                                <div class="sidebar-box pt-md-4">
                                    <form action="#" class="search-form">
                                        <div class="form-group">
                                            <span class="icon icon-search"></span>
                                            <input type="text" class="form-control" placeholder="Type a keyword and hit enter">
                                        </div>
                                    </form>
                                </div>
                                <div class="sidebar-box ftco-animate">
                                    <h3 class="sidebar-heading">Categories</h3>
                                    <ul class="categories">
                                        @foreach($categories as $category)
                                            <li><a href="{{route('index', ['category_id' => $category->id])}}">{{$category->name}} <span>{{$category->comments->count()}}</span></a></li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="sidebar-box ftco-animate">
                                    <h3 class="sidebar-heading">Recent Posts</h3>
                                    @foreach($recentPosts as $post)
                                        <div class="block-21 mb-4 d-flex">
                                            <a href="{{route('post', ['slug' => $post->slug])}}" class="blog-img mr-4" style="background-image: url({{env('POST_IMAGE_PUBLIC_PATH').$post->image_path}});"></a>
                                            <div class="text">
                                                <h3 class="heading"><a href="{{route('post', ['slug' => $post->slug])}}">{{$post->title}}</a></h3>
                                                <div class="meta">
                                                    <div><span class="icon-calendar"></span> {{$post->created_at}}</div>
                                                    <div><a href="#"><span class="icon-person"></span>{{$post->creator->name}}</a></div>
                                                    <div>
                                                        <a href="#">
                                                            <span class="icon-chat"></span>&nbsp;{{$post->comments->count()}}
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>

    <script src="/js/vendor/jquery.min.js"></script>
    <script src="/js/vendor/jquery-migrate-3.0.1.min.js"></script>
    <script src="/js/vendor/jquery.waypoints.min.js"></script>
    <script src="/js/vendor/jquery.stellar.min.js"></script>
{{--    <script src="js/vendor/aos.js"></script>--}}
    <script src="/js/vendor/main.js"></script>
</body>
</html>
