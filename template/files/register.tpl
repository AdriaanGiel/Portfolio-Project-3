<div class="jumbotron">
    <h1>Register</h1>
</div>

<div class="col-sm-8 blog-main">

    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
    </ol>
    <div class="blog-post">

        <!-- START BLOCK : ERRORS -->
        <div class="alert alert-danger" role="alert">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            {ERROR}
        </div>
        <!-- END BLOCK : ERRORS -->

        <!-- START BLOCK : MELDING -->
        <div class="alert alert-info" role="alert">
            <p>{MELDING}</p>
        </div>
        <!-- END BLOCK : MELDING -->


        <!-- START BLOCK : USERFORM -->
        <form class="form-horizontal" action="{ACTION}" method="post">
            <div class="form-group">
                <label for="inputvnaam" class="col-sm-4 control-label">Voornaam</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputvnaam" placeholder="Voornaam" name="vnaam" value="{VOORNAAM}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputanaam" class="col-sm-4 control-label">Achternaam</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputanaam" placeholder="Achternaam" name="anaam" value="{ACHTERNAAM}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputgnaam" class="col-sm-4 control-label">Gebruikersnaam</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="inputgnaam" placeholder="Gebruikersnaam" name="gnaam" value="{USERNAME}">
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail" class="col-sm-4 control-label">Email</label>
                <div class="col-sm-8">
                    <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" value="{EMAIL}">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword1" class="col-sm-4 control-label">Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="inputPassword1" placeholder="Password" name="password1">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword2" class="col-sm-4 control-label">Herhaal Password</label>
                <div class="col-sm-8">
                    <input type="password" class="form-control" id="inputPassword2" placeholder="Herhaal Password" name="password2">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <input type="hidden" name="accountid" value="{ACCOUNTID}">
                    <input type="hidden" name="userid" value="{USERID}">
                    <button type="submit" class="btn btn-default">{BUTTON}</button>
                </div>
            </div>
        </form>

        <!-- END BLOCK : USERFORM -->