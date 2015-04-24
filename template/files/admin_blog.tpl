
<div class="jumbotron">
    <h1>Admin Blog</h1>
</div>

<div class="col-sm-8 blog-main">

    <ol class="breadcrumb">
        <li><a href="#">Home</a></li>
        <li><a href="#">Library</a></li>
        <li class="active">Data</li>
    </ol>
    <div class="blog-post">
        <p>
            <a href="index.php?pageid=3">Overzicht</a> -
            <a href="index.php?pageid=3&action=toevoegen">Blog toevoegen</a>
        </p>

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

        <!-- START BLOCK : FBLOG -->
        <form class="form-horizontal" action="{ACTION}" method="post">
            <div class="form-group">
                <label for="blognaam" class="col-sm-2 control-label">Blog Titel</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="blognaam" placeholder="Blog Titel" name="blognaam" value="{TITEL}" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="blogpost" class="col-sm-2 control-label">Post</label>
                <div class="col-sm-8">
                    <textarea class="form-control" rows="10" placeholder="Plaats een comment" id="blogpost" name="blogpost">{CONTENT}</textarea>
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <input type="hidden" name="accountid" value="{ACCOUNTID}">
                    <input type="hidden" name="roleid" value="{IDROLE}">
                    <input type="hidden" name="blogid" value="{IDBLOG}">
                    <button type="submit" name="post" class="btn btn-default">{BUTTON}</button>
                </div>
            </div>
        </form>
        <!-- END BLOCK : FBLOG-->

        <!-- START BLOCK : BLOGLIST -->

        <div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline" action="index.php?pageid=3" method="post" >
                    <div class="form-group">
                        <input type="text" class="form-control" id="Search" placeholder="Zoek" name="search" value="{SEARCH}">
                    </div>
                    <button type="submit" class="btn btn-default">Zoek</button>
                </form>
            </div>
        </div>

        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>Gebruikersnaam</th>
                <th>Title</th>
                <th>Post</th>
                <th>Wijzigen</th>
                <th>Verwijderen</th>
            </tr>
            </thead>
            <tbody>
            <!-- START BLOCK : BLOGROW -->
            <tr>
                <td>{USERNAME}</td>
                <td>{TITLE}</td>
                <td id="contentblog">{CONTENT}</td>
                <td><a href="index.php?pageid=3&action=wijzigen&blogid={IDBLOG}">Wijzigen</a></td>
                <td><a href="index.php?pageid=3&action=verwijderen&blogid={IDBLOG}">Verwijderen</a></td>
                <td></td>
            </tr>
            <!-- END BLOCK : BLOGROW -->
            </tbody>
        </table>

        <!-- END BLOCK : BLOGLIST -->

    </div>
</div>
