<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            {{--
                TODO:
                1. Project name with Logo
                2. Single page homepage with #references to menubar
            --}}

            <a class="navbar-brand" href="#">UniTrack</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

            @if(!auth()->user())
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
            </ul>
            @elseif(auth()->user()->type == 'admin')
                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/AdminPanel') }}">Dashboard</a></li>
                    <li><a href="{{ url('/Users/ViewUsers') }}">User Master</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            @endif
            <ul class="nav navbar-nav navbar-right">
                @if(\Illuminate\Support\Facades\Auth::user())
                    <li><a href="#">Welcome, {{ auth()->user()->name }}</a></li>
                    <li><a href="{{url('auth/logout')}}">Logout</a></li>
                @endif
            </ul>
        </div><!--/.nav-collapse -->
    </div><!--/.container-fluid -->
</nav>