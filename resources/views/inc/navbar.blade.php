
<style type="text/css">
	.nav-link{
		color: #fff;
	}
</style>

<nav class="navbar navbar-expand-lg bg-primary">
	<div class="container-fluid">
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	  </button>
	  {{-- <a class="navbar-brand" href="/">{{ config('app.name', 'IPP') }}</a> --}}

	  <div class="collapse navbar-collapse container-fluid" id="navbarTogglerDemo03">
	    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
			<li class="nav-item"><a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a></li>
			<li class="nav-item"><a class="nav-link" href="/play">Let's play </a></li>
			<li class="nav-item"><a class="nav-link" href="/statistics">Statistics </a></li>
	    </ul>
	    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
	    	@if (Route::has('login'))
                    @auth
                    	@if(Auth::user()->type=='cm')
                    		<li class="nav-item"><a class="nav-link" href="/buildings/create">Create Building</a></li>
                    		<li class="nav-item"><a class="nav-link" href="/minmaxes/create">Create Item Type</a></li>
                    		<li class="nav-item"><a class="nav-link" href="/ecgitems/create">Create ECG Item</a></li>
                    	@endif
                    @else
                    	<li class="nav-item"><a class="nav-link" href="{{ route('login') }}">Login</a></li>
                    	<li class="nav-item"><a class="nav-link" href="{{ route('register') }}">Register</a></li>
                    @endauth
            @endif	
		</ul>
	</div>
	@if (Route::has('login'))
        @auth
			<div class="dropdown">
			  <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			     {{ Auth::user()->Nickname }} <span class="caret"></span>
			  </a>

			  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			    <div class="dropdown-item">
			    	<a class="btn fa fa-btn fa-sign-out" href="/profile">Profile</a>
			    </div>
			    <div class="dropdown-item">
			    	<a class="btn fa fa-btn fa-sign-out" href="/dashboard">Dashboard</a>
			    </div>
			    <a name="forms">
				<a name="csrf-field">
			    <form class="dropdown-item" action="{{ url('/logout') }}" method="POST">
			    	@csrf
						<!-- @method('POST') -->
			    	<input type="submit" class=" btn fa fa-btn fa-sign-out" value="Logout">
			    </form>
			</a>
		</a>
			  </div>
			</div>
        @endauth
	@endif	
  </div>
</nav>
