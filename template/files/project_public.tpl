<div class="jumbotron">
    <h1>Projecten</h1>
</div>

<div class="col-sm-12 blog-main">
    <ol class="breadcrumb">
        <li><a href="index.php?pageid=10">Terug naar projecten</a></li>
    </ol>

    <div class="container marketing" id="marketing">

        <!-- START BLOCK : MELDING -->
        <div class="alert alert-info" role="alert">
            <p>{MELDING}</p>
        </div>
        <meta http-equiv="refresh" content="2; url=index.php?pageid=10&projectid={IDPROJECT}" />
        <!-- END BLOCK : MELDING -->
        <!-- Three columns of text below the carousel -->

        <!-- START BLOCK : BEGIN -->
        <div class="row">
            <!-- END BLOCK : BEGIN -->

            <!-- START BLOCK : PROJECT -->
            <div class="col-sm-6 col-md-4">
                <div class="thumbnail" id="projectbox">
                    <img src="{IMAGE}" alt="PRODUCT" id="projectimg">
                    <div class="caption">
                        <h3>{TITLE}</h3>
                        <p>{CONTENT}</p>
                        <p><a href="index.php?pageid=10&projectid={PROJECTID}" class="btn btn-primary" role="button">Lees Verder</a></p>
                    </div>
                </div>
            </div>
            <!-- END BLOCK : PROJECT -->

            <!-- START BLOCK : END -->
        </div><!-- /.row -->
        <!-- END BLOCK : END -->
    </div>

    <!-- START BLOCK : COMMENTMELDING -->
    <div class="blog-post" id="projectcomments">
        <!-- START BLOCK : WIJZIGEN -->
        <form class="form-horizontal" method="post" action="index.php?pageid=10&projectid={IDPROJECT}&commentid={COMMENTID}&action=wijzigen" >
            <div class="panel panel-default" id="commentwij">
                <div class="panel-heading" id="commentwijhead">{USERNAME}</div>
                <div class="panel-body">
                    <textarea class="form-control" name="comment2" rows="4" placeholder="Plaats een comment" id="comments1">{CONTENT}</textarea>
                </div>
                <div class="panel-footer">
                    <input type="hidden" name="commentid" value="{COMMENTID}"/>
                    <button type="submit" name="submitpost" class="btn btn-warning btn-xs">Wijzigen</button>
                </div>
            </div>
        </form>
        <!-- END BLOCK : WIJZIGEN -->

        <!-- START BLOCK : VERWIJDEREN -->
        <div class="panel panel-danger" >
            <div class="panel-heading">
                <h3 class="panel-title">Weet u zeker dat u deze comment wilt verwijderen</h3>
            </div>
            <div class="panel-body">
                <div class="well" id="wells">
                    <div class="media">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" src="..." alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <h4 class="media-heading"><span id="comments">Posted by</span> {USERNAME}</h4>
                            {CONTENT}

                        </div>
                    </div>
                </div>
            </div>
            <div class="panel-footer">
                <form method="post" action="index.php?pageid=10&projectid={IDPROJECT}&commentid={COMMENTID}&action=verwijderen">
                    <div class="form-group" id="verbutton">
                        <input type="hidden" name="commentid" value="{COMMENTID}"/>
                        <button type="submit" name="submitpost" id="verbutton" class="btn btn-danger btn-xs">Verwijderen</button>
                    </div>
                </form>

            </div>

        </div>
    <!-- END BLOCK : VERWIJDEREN -->
    </div>
    <!-- END BLOCK : COMMENTMELDING -->
    <div class="blog-post" id="projectfull">
        <!-- START BLOCK : DETAILS -->

            <h2 class="blog-post-title">{TITLE}</h2>
            <p class="blog-post-meta">Geplaats door <a href="index.php?pageid=12">{USERNAME}</a></p>
            <hr>
            <img src="{IMAGE}" alt=""/>
            <hr>
            <p>{CONTENT}</p>
            <hr>
        <!-- END BLOCK : DETAILS -->
    </div>
    <div class="blog-post" id="projectcomments">
    <!-- START BLOCK : MELDINGTW -->
    <div class="well">Als je een reactie wilt plaatsen moet je ingelogd zijn.</div>
    <!-- END BLOCK : MELDINGTW -->

        <!-- START BLOCK : COMMENTFORM -->
        <form class="form-horizontal" method="post" action="index.php?pageid=10&projectid={IDPROJECT}" >
            <div class="panel panel-default" >
                <div class="panel-heading">Comments</div>
                <div class="panel-body">
                    <textarea class="form-control" name="comment" rows="4" placeholder="Plaats een comment" id="comments">{CONTENT}</textarea>
                </div>
                <div class="panel-footer">
                    <input type="hidden" name="idproject" value="{IDPROJECT}"/>
                    <button type="submit" name="submitpost" class="btn btn-primary btn-xs">Plaats</button>
                </div>
            </div>
        </form>
        <!-- END BLOCK : COMMENTFORM -->


        <!-- START BLOCK : COMMENTS -->
        <div class="panel panel-default">
            <div class="panel-heading"><span id="commentvak">Reacties</span>
            </div>
            <!-- START BLOCK : COMMENTSROW --></div>

        <div class="panel-body">
            <div class="well" id="wells">
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object" src="..." alt="...">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><span id="comments">Posted by</span> {USERNAME}</h4>
                        {CONTENT}

                    </div>


                    <!-- START BLOCK : COMMENTAMDMIN -->
                    <div class="panel-heading">
                        <a class="btn btn-warning btn-xs" href="index.php?pageid=10&projectid={IDPROJECT}&commentid={COMMENTID}&action=wijzigen" role="button">Wijzigen</a>
                        <a class="btn btn-danger btn-xs" href="index.php?pageid=10&projectid={IDPROJECT}&commentid={COMMENTID}&action=verwijderen" role="button" role="button"> Verwijderen</a>
                    </div>
                    <!-- END BLOCK : COMMENTAMDMIN -->

                </div>
            </div>
        </div>
        <!-- END BLOCK : COMMENTSROW -->

    </div>
    <!-- END BLOCK : COMMENTS -->


    </div><!-- /.blog-post -->
    </div><!-- /.blog-post -->

</div>

