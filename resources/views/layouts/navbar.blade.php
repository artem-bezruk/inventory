<ul class="navbar-nav">
	<li class="nav-item">
		<a class="nav-link btn" data-widget="pushmenu"><i class="fas fa-bars"></i></a>
	</li>
</ul>
<ul class="navbar-nav ml-auto">
	<li class="nav-item dropdown user-menu">
		<a class="nav-link dropdown-toggle btn" data-toggle="dropdown">
			<img src="{{ asset('img/user3-128x128.jpg') }}" class="user-image img-circle elevation-2" alt="User Image">
			<span class="d-none d-md-inline">Sasha Pierce</span>
		</a>
		<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
			<li class="user-header bg-primary">
				<img src="{{ asset('img/user3-128x128.jpg') }}" class="img-circle elevation-2" alt="User Image">
				<p>
					Sasha Pierce - Web Developer
					<small>Member since Nov. 2012</small>
				</p>
			</li>
			<li class="user-footer">
				<a href="#" class="btn btn-default btn-flat">Profile</a>
				<a class="btn btn-default btn-flat float-right" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
			</li>
		</ul>
	</li>
</ul>
