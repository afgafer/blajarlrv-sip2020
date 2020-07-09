<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <!-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> -->

    <!-- bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <!-- style -->
    <link href="{{ asset('style/afstyle.css') }}" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,700"> -->
    @yield('head')
</head>

<body>
    <img class="position-fixed w-100 h-100" src="{{asset('storage/bg.jpg')}}">
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-dark bg-blue shadow-sm" style="font-size:18pt;">
            <div class="container">
                <img src="{{asset('storage/logo.png')}}" width="50px" >
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{asset('storage/text.png')}}" width="100px" >
                    <!-- <h2>{{ config('app.name', 'Laravel') }}</h2> -->
                </a>
                <!-- <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="">home</a>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle text-left" href="#" role="button"
                                    id="dDest" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    dests
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dDest">
                                    <a class="dropdown-item" href="{{route('dest.indexA')}}">
                                        list dest
                                    </a>
                                    <a class="dropdown-item" href="{{route('dest.map')}}">
                                        map
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                            <a class="nav-link dropdown-toggle text-left" href="#" role="button"
                                id="dHotel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                hotels
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dHotel">
                                <a class="dropdown-item" href="{{route('hotel.indexA')}}">
                                    list hotel
                                </a>
                                <a class="dropdown-item" href="{{route('hotel.map')}}">
                                    map
                                </a>
                            </div>
                        </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown">
                                <a class="nav-link dropdown-toggle text-left" href="#" role="button"
                                    id="dRoom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    rooms
                                </a>

                                <div class="dropdown-menu" aria-labelledby="dRoom">
                                    <a class="dropdown-item" href="{{route('room.indexA')}}">
                                        list room
                                    </a>
                                    <a class="dropdown-item" href="{{route('room.check')}}">
                                        check
                                    </a>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('image.indexA')}}">images</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('article.indexA')}}">articles</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('event.indexA')}}">events</a>
                        </li>
                        <!-- <li class="nav-item">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Launch demo modal
                            </button>
                        </li> -->
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto ">
                        <!-- Authentication Links -->
                        <!-- @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                        @endif
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest -->
                    </ul>
                </div>
                @if(Session::has('cart'))
                @php
                $cart=Session::get('cart');
                @endphp
                <a href="{{route('cart.index')}}"><span class="badge badge-success ml-5">{{$cart->tQty}}</span></a>
                @endif
                <a class="navbar-toggler-icon" onclick="openNav()"></a>
                <div id="mySidenav" class="sidenav bg-white">
                    <a href="javascript:void(0)" class="closebtn text-secondary" onclick="closeNav()">&times;</a>
                    @guest
                    <a class="list-group-item list-group-item-action bg-info text-white"
                        href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                    <a class="list-group-item list-group-item-action bg-info text-white"
                        href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                    @else
                    @php
                    if(Auth::user()->type==0){
                        $user=Auth::user()->member;
                    }
                    if(Auth::user()->type==1){
                        $user=Auth::user()->admin;
                    }
                    $dirF='upload/img/'.$user->file;
                    $src=asset($dirF);
                    @endphp
                    <div class="dropdown">
                        <a class="btn btn-info bg-info dropdown-toggle text-white p-2 text-left" href="#" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{$src}}" alt="{{$user->file}}" class="rounded-circle border border-secondary img-s">
                            {{Auth::user()->name}}
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    @endguest
                    <a href="{{route('home')}}"
                        class="list-group-item list-group-item-action bg-secondary text-white">home</a>
                    @auth
                    @php
                    if(Auth::user()->type==1){
                    $file=Auth::user()->admin->file;
                    }
                    else if(Auth::user()->type==0){
                    $file=Auth::user()->member->file;
                    }
                    $dirF="upload/img/".$file;
                    $src=asset($dirF);
                    @endphp
                    
                    @if(Auth::user()->type==1)
                        @if(Auth::user()->admin->hotel_id>0)
                        <a href="{{route('admin.show',Auth::user()->id)}}" class="list-group-item list-group-item-action">account</a>
                    <a href="{{route('dest.show',Auth::user()->admin->dest_id)}}"
                        class="list-group-item list-group-item-action">dest</a>
                    <a href="{{route('hotel.show',Auth::user()->admin->hotel_id)}}"
                        class="list-group-item list-group-item-action">hotel</a>
                    <a href="{{route('room.index')}}" class="list-group-item list-group-item-action">room</a>
                        @else
                        <a href="{{route('admin.show',Auth::user()->id)}}" class="list-group-item list-group-item-action">account</a>
                    <a href="{{route('dest.index')}}"
                        class="list-group-item list-group-item-action">dest</a>
                    <a href="{{route('hotel.index')}}"
                        class="list-group-item list-group-item-action">hotel</a>
                    <!-- <a href="{{route('admin.index')}}"
                        class="list-group-item list-group-item-action">admin</a> -->
                        @endif
                    <a href="{{route('image.index')}}" class="list-group-item list-group-item-action">image</a>
                    <a href="{{route('article.index')}}" class="list-group-item list-group-item-action">article</a>
                    <a href="{{route('event.index')}}" class="list-group-item list-group-item-action">event</a>
                        @if(Auth::user()->admin->hotel_id>0)
                    <a href="{{route('order.transaction')}}?status=transaction"
                        class="list-group-item list-group-item-action">transaction</a>
                    <a href="{{route('order.payment')}}?status=payment" class="list-group-item list-group-item-action">payment</a>
                    <a href="{{route('order.income')}}" class="list-group-item list-group-item-action">order</a>
                        @endif

                    @elseif(Auth::user()->type==0)
                    <a href="{{route('member.show',Auth::user()->id)}}" class="list-group-item list-group-item-action">account</a>
                    <!-- <a href="{{route('image.createA')}}" class="list-group-item list-group-item-action">Upload</a> -->
                    <a href="{{route('order.indexA')}}" class="list-group-item list-group-item-action">order</a>
                    <!-- <form action="{{route('cart.search')}}" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="list-group-item list-group-item-action">
                            Pesan
                            @if(Session::has('cart'))
                            @php
                            $cart=Session::get('cart');
                            @endphp
                            <span class="badge badge-success ml-5">{{$cart->tQty}}</span>
                            @endif
                        </button>
                    </form> -->
                    @endif
                    @endauth
                    <!-- <a href="{{route('dest.indexA')}}"
                        class="list-group-item list-group-item-action bg-secondary text-white">dests</a> -->
                    <div class="dropdown">
                        <a class="list-group-item list-group-item-action bg-secondary dropdown-toggle text-white text-left" href="#" role="button"
                            id="dDest" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            dests
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dDest">
                            <a claSS="dropdown-item" href="{{route('dest.indexA')}}">
                                list dest
                            </a>
                            <a class="dropdown-item" href="{{route('dest.map')}}">
                                map
                            </a>
                        </div>
                    </div>
                        <div class="dropdown">
                        <a class="list-group-item list-group-item-action bg-secondary dropdown-toggle text-white text-left" href="#" role="button"
                            id="dHotel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            hotels
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dHotel">
                            <a class="dropdown-item" href="{{route('hotel.indexA')}}">
                                list hotel
                            </a>
                            <a class="dropdown-item" href="{{route('hotel.map')}}">
                                map
                            </a>
                        </div>
                    </div>
                    <div class="dropdown">
                        <a class="list-group-item list-group-item-action bg-secondary dropdown-toggle text-white text-left" href="#" role="button"
                            id="dRoom" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            rooms
                        </a>

                        <div class="dropdown-menu" aria-labelledby="dRoom">
                            <a class="dropdown-item" href="{{route('room.indexA')}}">
                                list room
                            </a>
                            <a class="dropdown-item" href="{{route('room.check')}}">
                                check
                            </a>
                        </div>
                    </div>
                    <a href="{{route('image.indexA')}}"
                        class="list-group-item list-group-item-action bg-secondary text-white">images</a>
                    <a href="{{route('article.indexA')}}"
                        class="list-group-item list-group-item-action bg-secondary text-white">articles</a>
                    <a href="{{route('event.indexA')}}"
                        class   ="list-group-item list-group-item-action bg-secondary text-white">events</a>
                </div>
            </div>
        </nav>

        <!-- body -->
        <div class="row justify-content-md-center m-0 bg-transparent">

            <!-- <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">

            <div class="col-12 py-2 mx-1">
                <div class="list-group">
                    <a href="{{route('home')}}" class="list-group-item list-group-item-action bg-secondary text-white">
                        <img src="" style="width:40px;height:40px" alt="" class="rounded-circle border-white mr-1">
                        <h5 class="d-inline">Beranda</h5>
                    </a>
                    <a href="{{route('dest.index')}}" class="list-group-item list-group-item-action">dest</a>
                    <a href="{{route('hotel.index')}}" class="list-group-item list-group-item-action">hotel</a>
                    <a href="{{route('article.index')}}" class="list-group-item list-group-item-action">article</a>
                    <a href="{{route('image.index')}}" class="list-group-item list-group-item-action">image</a>
                    <a href="{{route('event.index')}}" class="list-group-item list-group-item-action">event</a>
                    <a href="{{route('order.index')}}" class="list-group-item list-group-item-action">order</a>
                    <form action="{{route('cart.search')}}" method="post">
                        {{csrf_field()}}
                        <button type="submit" class="list-group-item list-group-item-action">
                            Pesan
                            @if(Session::has('cart'))
                            @php
                            $cart=Session::get('cart');
                            @endphp
                            <span class="badge badge-success ml-5">{{$cart->tQty}}</span>
                            @endif
                        </button>
                    </form>
                </div>
            </div>

    </div>
  </div>
</div> -->
            <div class="col-md-11 p-2" style="">
                @yield('top')
            </div>
            <div class="col-md-11 bg-white mx-2 rounded p-2 pb-3 " style="min-height:60vh">
                @yield('content')
            </div>
            <div class="col-md-11 p-2 " style="">
                @yield('section')
            </div>
        </div>
        <!-- end_body -->
        <div class="col-12 bg-dark" style="height:200px;">
                
        </div>
    </div>
    <!-- script -->
    <!-- bootstrap -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n"
        crossorigin="anonymous"></script>
    <!-- bootstrap -->
    @yield('script')
    <!-- bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
        crossorigin="anonymous"></script>
    <script>
        /* Set the width of the side navigation to 250px */
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
        }

        /* Set the width of the side navigation to 0 */
        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
        }
    </script>
</body>

</html>