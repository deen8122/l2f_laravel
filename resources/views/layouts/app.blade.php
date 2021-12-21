<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Письмо в будущее</title>
	<link rel="shortcut icon" href="/favicon.png" />	
	<meta name="csrf-token" content="{{ csrf_token() }}" />
	<script src="/js/jquery.min.js"></script>
	<script src="/js/functions.js"></script>
	<script src="/js/main.js"></script>
	<link href="/l2f/css/jquery.mobile.structure-1.4.5.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/app.css" />
	<script type="text/javascript">
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
	</script>
    </head>
    <body style="margin: 0">
	<div class="app-conatiner" style="z-index: 1">
	    <div data-theme="a" data-role="header" style="z-index: 999" role="banner" class="ui-header ui-bar-a">
		<a href="#mypanel" id="top-menu" class="ui-link ui-btn-left ui-btn ui-shadow ui-corner-all" data-role="button" role="button"><span class="icon2 icon-menu"></span></a>
		<h1 class="ui-title" role="heading" aria-level="1">Letter2Future.ru - письмо в будущее</h1>
	    </div>

	    @section('sidebar')
	    @include('include.menu')
	    @show
	    <div id="content" class="main-content">
		@yield('content')
	    </div>
	</div>
	@include('include.layers')
	<script src="/js/popups.js"></script>
    </body>
</html>