<html>
	<head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0,">
		<?= stylesheet_link_tag() ?>
		<?= javascript_include_tag() ?>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
	</head>
    <body>
        <div id="wrapper">
			@yield('content')
        </div>
    </body>
</html>