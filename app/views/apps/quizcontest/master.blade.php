<html>
	<head>
        <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0,">
		<?= stylesheet_link_tag('apps/quizcontest/application') ?>
        <?= javascript_include_tag('apps/quizcontest/application') ?>
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
        @section('css_tag')

        @stop
        @yield('css_tag')
	</head>
    <body>
        <div id="wrapper">
			@yield('content')
        </div>
    </body>
</html>