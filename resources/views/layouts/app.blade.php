<html>
    <head>
    	<meta charset="UTF-8">
	    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	    <meta http-equiv="X-UA-Compatible" content="ie=edge">

	    <title>PDM | @yield('title')</title>
	    <base href="{{asset('')}}">
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet" type="text/css">
	    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	    <link rel="stylesheet" type="text/css" href="css/main.css">
	    <link rel="stylesheet" type="text/css" href="css/index.css">
    </head>
    <body>
	<div id="app">
		<top></top>
    	<div class="content">
    		<div class="wrapper">
			    <div class="content-block">
			      	<div class="content-block-wrapper">
				        <div class="overlap-header" id="change-list">
				        	<span class="button overlap-button-list" id="list-button"><i class="fa fa-list-alt fa-2x list-icon" aria-hidden="true" style="margin-right: 10px; color: #FF43F8;"></i></span>
				        </div>

				        <div class="overlap-header" id="change-thumbnail">
				        	<span class="button overlap-button-thumbnail" id="thumbnail-button"><i class="fa fa-picture-o fa-2x thumbnail-icon" aria-hidden="true" style="margin-right: 10px; color: #51EA2D; margin-bottom: 1px;"></i></span>
				        </div>
				        <div class="loaderImage" :class="{active: loadingData}" >Loading...</div>
				    </div>
			    </div>
			</div>
    	@yield('content')
    	</div>
	</div>

		{{-- Script load here--}}
		<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

		<script src="{{ asset('js/main.js') }}"></script>
		<script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>

<style type="text/css">

</style>
