<div class="jumbotron">
    <h1>Login</h1>
</div>
<div class="col-sm-8 blog-main">
    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
    </ol>

    <!-- START BLOCK : ERRORS -->
    <div class="alert alert-danger" role="alert">
        <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
        <span class="sr-only">Error:</span>
        {ERROR}
    </div>
    <!-- END BLOCK : ERRORS -->

    <div class="blog-post">
        <!-- START BLOCK : MELDING -->
        <div class="alert alert-info" role="alert">
            <p>{MELDING}</p>
        </div>
        <meta http-equiv="refresh" content="1; url=index.php?pageid={PAGE}" />
        <!-- END BLOCK : MELDING -->
        <!-- START BLOCK : LOGINFORM -->
        <form class="form-horizontal" action="index.php?pageid=4" method="post">
            <div class="form-group">
                <label for="inputgnaam" class="col-sm-4 control-label">Gebruikersnaam</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputgnaam" placeholder="Gebruikersnaam" name="gnaam" value="{USERNAME}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword1" class="col-sm-4 control-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="inputPassword1" placeholder="Password" name="password">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <input type="hidden" name="pageid" value="1">
                    <button type="submit" class="btn btn-default">Login</button>
                </div>
            </div>
        </form>
        <div class="btn-group btn-group-xs col-sm-offset-4 col-sm-8" role="group" aria-label="...">
            <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                vergeten? <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="index.php?pageid=11&action=1&option=1">Username vergeten</a></li>
                <li><a href="index.php?pageid=11&action=1&option=2">Wachtwoord vergeten</a></li>
                <li><a href="index.php?pageid=11&action=1&option=3">Wachtwoord + username vergeten</a></li>
            </ul>
        </div>
        <!-- END BLOCK : LOGINFORM -->
    </div><!-- /.blog-post -->
</div>
<div class="col-sm-3 col-sm-offset-1 blog-sidebar">
    <div class="sidebar-module sidebar-module-inset">
        <h4>About</h4>
        <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
    </div>
    <div class="sidebar-module">
        <h4>Archives</h4>
        <ol class="list-unstyled">
            <li><a href="#">March 2014</a></li>
            <li><a href="#">February 2014</a></li>
            <li><a href="#">January 2014</a></li>
            <li><a href="#">December 2013</a></li>
            <li><a href="#">November 2013</a></li>
            <li><a href="#">October 2013</a></li>
            <li><a href="#">September 2013</a></li>
            <li><a href="#">August 2013</a></li>
            <li><a href="#">July 2013</a></li>
            <li><a href="#">June 2013</a></li>
            <li><a href="#">May 2013</a></li>
            <li><a href="#">April 2013</a></li>
        </ol>
    </div>
    <div class="sidebar-module">
        <h4>Elsewhere</h4>
        <ol class="list-unstyled">
            <li><a href="#">GitHub</a></li>
            <li><a href="#">Twitter</a></li>
            <li><a href="#">Facebook</a></li>
        </ol>
    </div>
</div>