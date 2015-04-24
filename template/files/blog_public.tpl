<div class="jumbotron">
    <!-- START BLOCK : GROOTT -->
    <h1>{GROTTITEL}</h1>
    <!-- END BLOCK : GROOTT -->
</div>

<div class="col-sm-10 blog-main">

    <div class="blog-post">
        <p>
            <a href="index.php?pageid=7">Overzicht</a> -
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
        <meta http-equiv="refresh" content="2; url=index.php?pageid=7&blogid={IDBLOG}" />
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
            <label for="editor1" class="col-sm-2 control-label">Content</label>
            <div class="col-sm-10">
                <textarea class="ckeditor" rows="3" name="content" id="editor1" placeholder="Content">{CONTENT}</textarea>
            </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-8">
                    <input type="hidden" name="accountid" value="{ACCOUNTID}">
                    <input type="hidden" name="blogid" value="{IDBLOG}">
                    <button type="submit" name="post" class="btn btn-default">{BUTTON}</button>
                </div>
            </div>
        </form>
        <!-- END BLOCK : FBLOG-->


        <!-- START BLOCK : BLOGLIST -->

        <!--<div class="panel panel-default">
            <div class="panel-body">
                <form class="form-inline" action="index.php?pageid=7" method="post" >
                    <div class="form-group">
                        <input type="text" class="form-control" id="Search" placeholder="Zoek" name="search" value="{SEARCH}">
                    </div>
                    <button type="submit" class="btn btn-default">Zoek</button>
                </form>
            </div>
        </div>-->


            <!-- START BLOCK : BLOGROW -->
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3>{TITLE} </h3>
                    <span class="label label-success">{USERNAME}</span>
                </div>
                <div class="panel-body" id="overflow">
                    <p>{CONTENT}</p>
                </div>
                <div class="panel-footer">
                    <div class="btn-toolbar" role="toolbar" aria-label="...">
                        <div class="btn-group" role="group" aria-label="...">
                            <a href="index.php?pageid=7&blogid={IDBLOG}">Lees verder &raquo;</a>
                        </div>
                    </div>
                </div>
            </div>
        <!-- END BLOCK : BLOGROW -->
        <!-- END BLOCK : BLOGLIST -->


        <!-- START BLOCK : BLOGROWSP -->
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3>{TITLE}</h3>
                <span class="label label-success">{USERNAME}</span>
            </div>
            <div class="panel-body" id="overflow">
                <p>{CONTENT}</p>
            </div>
            <div class="panel-footer">
                <div class="btn-toolbar" role="toolbar" aria-label="...">
                    <div class="btn-group" role="group" aria-label="...">
                        <!-- <a href="index.php?pageid=9&blogid={IDBLOG}">Lees verder</a> -->
                    </div>
                </div>
            </div>
        </div>


        <!-- END BLOCK : BLOGROWSP -->

        <!-- START BLOCK : MELDINGTW -->
        <div class="well">Als je een reactie wilt plaatsen moet je ingelogd zijn.</div>
        <!-- END BLOCK : MELDINGTW -->

        <!-- START BLOCK : COMMENTFORM -->
        <form class="form-horizontal" method="post" action="index.php?pageid=7&blogid={IDBLOG}">
            <div class="panel panel-default">
                <div class="panel-heading">Comments</div>
                <div class="panel-body">
                    <textarea class="form-control" name="comment" rows="4" placeholder="Plaats een comment" id="comments">{CONTENT}</textarea>
                </div>
                <div class="panel-footer">
                    <input type="hidden" name="idblog" value="{IDBLOG}"/>
                    <button type="submit" name="submitpost" class="btn btn-primary btn-xs">Plaats</button>
                </div>
            </div>
        </form>
        <!-- END BLOCK : COMMENTFORM -->

        <!-- START BLOCK : COMMENTMELDING -->

        <!-- START BLOCK : WIJZIGEN -->
        <form class="form-horizontal" method="post" action="index.php?pageid=7&blogid={IDBLOG}&commentid={COMMENTID}&action=wijzigen">
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
        <div class="panel panel-danger">
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
                <form method="post" action="index.php?pageid=7&blogid={IDBLOG}&commentid={COMMENTID}&action=verwijderen">
                    <div class="form-group" id="verbutton">
                        <input type="hidden" name="commentid" value="{COMMENTID}"/>
                        <button type="submit" name="submitpost" id="verbutton" class="btn btn-danger btn-xs">Verwijderen</button>
                    </div>
                </form>

            </div>

        </div>
        <!-- END BLOCK : VERWIJDEREN -->


        <!-- END BLOCK : COMMENTMELDING -->



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
                            <a class="btn btn-warning btn-xs" href="index.php?pageid=7&blogid={IDBLOG}&commentid={COMMENTID}&action=wijzigen" role="button">Wijzigen</a>
                            <a class="btn btn-danger btn-xs" href="index.php?pageid=7&blogid={IDBLOG}&commentid={COMMENTID}&action=verwijderen" role="button" role="button"> Verwijderen</a>
                        </div>
                        <!-- END BLOCK : COMMENTAMDMIN -->

                    </div>
                </div>
            </div>
            <!-- END BLOCK : COMMENTSROW -->

        </div>
        <!-- END BLOCK : COMMENTS -->

    </div>
</div>

<!--<a class="btn btn-warning btn-xs" href="index.php?pageid=7&blogid={IDBLOG}&commentid={COMMENTID}&action=wijzigen" role="button">Wijzigen</a>
<a class="btn btn-danger btn-xs" href="index.php?pageid=7&blogid={IDBLOG}&commentid={COMMENTID}&action=verwijderen" role="button"> Verwijderen</a>-->