<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		@include('frontend.layouts.headcss')
		@stack('styles')
	</head>
    <body>
		@include('frontend.layouts.scroll')
		<div id="wrapper">
			@include('frontend.layouts.header-top')
			@include('frontend.layouts.header-menu')
			@yield('main-content')
			@include('frontend.layouts.footer')
			@include('frontend.layouts.search-bar')
		</div>
		@include('frontend.layouts.footerjs')
		@stack('scripts')
	</body>
</html>