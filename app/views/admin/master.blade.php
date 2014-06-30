<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0,">
        <?= stylesheet_link_tag('admin/application') ?>
        <?= javascript_include_tag() ?>
        <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div id="wrapper">

            <div class="navbar navbar-default">
              <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">GalaxyStudio</a>
              </div>
              <div class="navbar-collapse collapse navbar-responsive-collapse">
                <ul class="nav navbar-nav">
                  <li class="active"><a href="#">Report</a></li>
                  <li><a href="#">Users</a></li>
                  <!--<li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Action</a></li>
                      <li><a href="#">Another action</a></li>
                      <li><a href="#">Something else here</a></li>
                      <li class="divider"></li>
                      <li class="dropdown-header">Dropdown header</li>
                      <li><a href="#">Separated link</a></li>
                      <li><a href="#">One more separated link</a></li>
                    </ul>
                  </li>-->
                </ul>
                <form class="navbar-form navbar-left">
                  <input type="text" class="form-control col-lg-8" placeholder="Search">
                </form>
                <ul class="nav navbar-nav navbar-right">
                  <!--<li><a href="#">Link</a></li>-->
                  <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                      <li><a href="#">Account Info</a></li>
                      <li><a href="#">Change password</a></li>
                      <li class="divider"></li>
                      <li><a href="#">Log out</a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>

            <div class='col-lg-2' id='panel'>
            @yield('panel')
            </div>

            <div class='col-lg-8' id='content'>
            @yield('content')
            </div>
        </div>
    </body>
</html>
