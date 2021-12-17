<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Vue SPA Demo</title>


    </head>
    <body class="font-sans antialiased">
	<div class="container" style="max-width:1200px; margin:auto">

	    <div id="app">
		<app></app>
	    </div>
	</div>


	<script src="{{ mix('js/app.js') }}"></script>
	<style>
	    .container-main { margin-top: 50px;}
	    h1 {text-align: center;font-size: 24px; font-weight: bold}
	    .ul-menu li { display: inline; /* Отображать как строчный элемент */
			  margin-right: 5px; /* Отступ слева */
			  border: 1px solid #000; /* Рамка вокруг текста */
			  padding: 3px; /* Поля вокруг текста */}
	    .router-link-exact-active {background: green}
	</style>
    </body> 
</html>