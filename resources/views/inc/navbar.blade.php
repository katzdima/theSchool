<header>
    <nav class="navbar navbar-default navbar-fixed-top">
         <div class="container">
               <div class="navbar-header">
                    <a class="navbar-brand" href="http://localhost:8080/theSchool/public/">
                    <img class="navPic" alt="The School" src="{{ url ('/storage/logoPic.jpg')}}">
                 </a>
                 <a class="navbar-brand" href="http://localhost:8080/theSchool/public/">The School</a>
               </div>
               <ul class="nav navbar-nav">
                    @if (!Auth::guest())
                        <li role="separator" class="divider-vertical"></li>
                        <li><a href="{{url ('/school')}}">School</a></li>
                            @if(!(Auth::user()->role === 3))
                                <li role="separator" class="divider-vertical"></li>
                                <li><a href="{{url ('/administration')}}">Administration</a></li>
                            @endif
                        <li role="separator" class="divider-vertical"></li>
                        <li><a href="{{url ('/about')}}">About</a></li>
                    @endif
               </ul>

               <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li><a class="navUserLink" href="{{url ('/administration/'.Auth::user()->id)}}"><img class="navPic" src="{{url ('storage/user_images/'.Auth::user()->image)}}" alt="User profile image"></a><li>
                    <li><a class="navUserLinkName" href="{{url ('/administration/'.Auth::user()->id)}}">{{ Auth::user()->name }}</a><li>
                    <li>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                              document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </li>
                @endif
            </ul>
          </div>
    </nav>
</header>