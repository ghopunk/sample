<!DOCTYPE html>
<html lang="en">
    <head>
       <meta charset='UTF-8' />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<title>
			@hasSection ('title')
				@yield('title') - Ghopunk
			@else
				Ghopunk
			@endif
		</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
		@yield('header')
    </head>
    <body>
		<div class="container">
			<div class="row">
				@yield('content')
			</div>
		</div>
		@yield('footer')
	</body>
</html>
