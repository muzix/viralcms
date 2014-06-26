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
            <div class="modal" id="pleaseWaitDialog"  data-backdrop="static" data-keyboard="false">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header"><h1>Đang tải...</h1></div>
                            <div class="modal-body">
                                <div class="progress progress-striped active">
                                    <div class="progress-bar" style="width: 100%;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			@yield('content')
        </div>
    </body>
</html>