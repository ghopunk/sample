<div class="navbar mb-3">
	@if (auth()->guard('login')->check())
	<a class="btn btn-secondary" href="{{ route('logout') }}" style="min-width: 100px;">Logout</a>
	<div>
		<div>Welcome Back, {{ auth()->guard('login')->user()->user }}</div>
	</div>
	@else
	<a class="btn btn-info" href="{{ route('login') }}" style="min-width: 100px;">Login</a>
	<div>
		<a class="btn btn-link" href="{{ route('report') }}" style="min-width: 100px;">Report</a>
	</div>
	@endif
</div>