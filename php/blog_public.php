<?php
$content = new TemplatePower("template/files/blog_public.tpl");
$content->prepare();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}

if (isset($_GET['blogid'])){
    $content->newBlock("GROOTT");
    $content->assign("GROTTITEL", "BlogDetail");

    $content->newBlock("BLOGROWSP");
    $check_blog = $db->prepare("SELECT count(*) FROM blog
                                WHERE blog.idBlog = :idblog");
    $check_blog->bindParam(":idblog", $_GET['blogid']);
    $check_blog->execute();

    if($check_blog->fetchColumn() == 1){
        try{
            $get_blog = $db->prepare("SELECT b.*, a.Username
                                      FROM blog b, accounts a
                                      WHERE b.idBlog = :idblog AND b.Accounts_idAccounts = a.idAccounts");
            $get_blog->bindParam(":idblog", $_GET['blogid']);
            $get_blog->execute();

        }catch (PDOException $error){
            $content->newBlock("ERRORS");
            $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
        }
        $blog = $get_blog->fetch(PDO::FETCH_ASSOC);

        $content->assign(array(
            "TITLE"     => $blog['Title'],
            "CONTENT"   => $blog['Content'],
            "USERNAME"  => $blog['Username'],
            "IDBLOG"    => $blog['idBlog']
        ));

        if(isset($_SESSION['accountid'])){
            if(isset($_SESSION['roleid'])){
                if($_SESSION['roleid'] == 2){
                    if(isset($_GET['action'])and isset($_GET['commentid'])){
                        if($_GET['action'] == "wijzigen"){
                            if(!empty($_POST['comment2']) AND !empty($_POST['commentid'])){
                                try{
                                    $update_comment = $db->prepare("UPDATE comments
                                                                    SET Text = :content
                                                                    WHERE comments.idComments = :commentid");
                                    $update_comment->bindParam(":content", $_POST['comment2']);
                                    $update_comment->bindParam(":commentid", $_POST['commentid']);
                                    $update_comment->execute();

                                    $content->newBlock("MELDING");
                                    $content->assign(array(
                                        "MELDING" => "COMMENT IS GEWIJZIGT",
                                        "IDBLOG" => $_GET['blogid']
                                    ));

                                }catch (PDOException $error){
                                    $content->newBlock("ERRORS");
                                    $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
                                }
                            }else{
                                if(isset($_GET['commentid'])){
                                    try{
                                        $check_comment = $db->prepare("SELECT count(*) FROM comments
                                                                    WHERE idComments = :commentid");
                                        $check_comment->bindParam(":commentid", $_GET['commentid']);
                                        $check_comment->execute();
                                    }catch (PDOException $error){
                                        $content->newBlock("ERRORS");
                                        $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
                                    }
                                    if($check_comment->fetchColumn() == 1){
                                        try{
                                            $get_comment = $db->prepare("SELECT comments.*, accounts.* FROM comments, accounts
                                                  WHERE comments.idComments = :commentid");
                                            $get_comment->bindParam(":commentid",$_GET['commentid'] );
                                            $get_comment->execute();

                                        }catch (PDOException $error){
                                            $content->newBlock("ERRORS");
                                            $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
                                        }
                                        $comment = $get_comment->fetch(PDO::FETCH_ASSOC);

                                        $content->newBlock("COMMENTMELDING");
                                        $content->newBlock("WIJZIGEN");
                                        $content->assign(array(
                                            "CONTENT"   => $comment['Text'],
                                            "USERNAME"  => $comment['Username'],
                                            "COMMENTID" => $comment['idComments'],
                                            "IDBLOG"    => $comment['Blog_idBlog']

                                        ));

                                    }else{
                                        $content->newBlock("ERRORS");
                                        $content->assign("ERROR", "Deze comment bestaat niet");
                                    }

                                }

                            }
                        }elseif($_GET['action'] == "verwijderen"){
                            if(!empty($_POST['commentid'])){
                                try{
                                    $delete_comment = $db->prepare("DELETE FROM comments
                                                                    WHERE comments.idComments = :commentid");
                                    $delete_comment->bindParam(":commentid", $_POST['commentid']);
                                    $delete_comment->execute();


                                    $content->newBlock("MELDING");
                                    $content->assign(array(
                                        "MELDING" => "COMMENT IS VERWIJDERD",
                                        "IDBLOG" => $_GET['blogid']
                                    ));


                                }catch (PDOException $error){
                                    $content->newBlock("ERRORS");
                                    $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
                                }

                            }else{
                                if(!empty($_GET['commentid'])){
                                    try{
                                        $check_comment = $db->prepare("SELECT count(*) FROM comments WHERE idComments = :commentid");
                                        $check_comment->bindParam(":commentid", $_GET['commentid']);
                                        $check_comment->execute();

                                    }catch (PDOException $error){
                                        $content->newBlock("ERRORS");
                                        $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
                                    }
                                    if($check_comment->fetchColumn() == 1){
                                          try{
                                              $get_comment = $db->prepare("SELECT comments.*, accounts.* FROM comments, accounts
                                                      WHERE comments.idComments = :commentid");
                                              $get_comment->bindParam(":commentid",$_GET['commentid'] );
                                              $get_comment->execute();

                                          }catch (PDOException $error){
                                              $content->newBlock("ERRORS");
                                              $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
                                          }

                                          $comment = $get_comment->fetch(PDO::FETCH_ASSOC);

                                          $content->newBlock("COMMENTMELDING");
                                          $content->newBlock("VERWIJDEREN");
                                          $content->assign(array(
                                              "CONTENT"   => $comment['Text'],
                                              "USERNAME"  => $comment['Username'],
                                              "COMMENTID" => $comment['idComments'],
                                              "IDBLOG"    => $comment['Blog_idBlog']
                                          ));
                                  }else{
                                        $content->newBlock("ERRORS");
                                        $content->assign("ERROR", "Deze comment bestaat niet");
                                    }
                                }
                            }

                        }
                    }else{
                        $content->newBlock("COMMENTFORM");
                        $content->assign("IDBLOG", $_GET['blogid']);
                    }

                }else{
                    $content->newBlock("COMMENTFORM");
                    $content->assign("IDBLOG", $_GET['blogid']);
                }
            }
            if(!empty($_POST['comment'])){
                try{
                    $insert_comment = $db->prepare("INSERT INTO comments SET
                                                    Text = :com,
                                                    Blog_idblog = :idblog,
                                                    Accounts_idAccounts = :accountid");
                    $insert_comment->bindParam(":com",$_POST['comment']);
                    $insert_comment->bindParam(":idblog",$_POST['idblog']);
                    $insert_comment->bindParam(":accountid", $_SESSION['accountid']);
                    $insert_comment->execute();

                    $content->newBlock("MELDING");
                    $content->assign(array(
                        "MELDING" => "COMMENT IS TOEGEVOEGT",
                        "IDBLOG" => $_GET['blogid']
                    ));

                }catch (PDOException $error){
                    $content->newBlock("ERRORS");
                    $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
                }
            }

        }else{
            $content->newBlock("MELDINGTW");

        }

        $check_comments = $db->prepare("SELECT count(*) FROM comments
                                            WHERE Blog_idBlog = :idblog");
        $check_comments->bindParam(":idblog", $_GET['blogid']);
        $check_comments->execute();

        if($check_comments->fetchColumn() > 0){
            try{
                $get_comments = $db->prepare("SELECT comments.*, accounts.Username
                                                  FROM comments, accounts
                                                  WHERE comments.Blog_idBlog = :idblog
                                                  AND comments.Accounts_idAccounts = accounts.idAccounts");
                $get_comments->bindParam(":idblog", $_GET['blogid']);
                $get_comments->execute();

            }catch (PDOException $error){
                $content->newBlock("ERRORS");
                $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
            }
            $content->newBlock("COMMENTS");
            while($comments = $get_comments->fetch(PDO::FETCH_ASSOC)){
                $content->newBlock("COMMENTSROW");
                $content->assign(array(
                    "CONTENT"   => $comments['Text'],
                    "USERNAME"  => $comments['Username'],
                    "IDBLOG"    => $comments['Blog_idBlog'],
                    "COMMENTID" => $comments['idComments']
                ));
                    if(isset($_SESSION['roleid'])){
                        if($_SESSION['roleid'] == 2){
                            //if wijzigen
                            //elsif verwijderen
                            //else V
                            $content->newBlock("COMMENTAMDMIN");
                            $content->assign("IDBLOG",$comments['Blog_idBlog']);
                            $content->assign("COMMENTID", $comments['idComments']);
                        }
                    }
                }
        }
    }

}else{

    $check_blog = $db->query("SELECT count(*) FROM blog");

    if($check_blog->fetchColumn() > 0){
        try{
            $get_blog = $db->query("SELECT blog.*, accounts.*
                                    FROM blog, accounts
                                    WHERE blog.Accounts_idAccounts = accounts.idAccounts");


        }catch (PDOException $error){
            $content->newBlock("ERRORS");
            $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
        }
        $content->newBlock("GROOTT");
        $content->assign("GROTTITEL", "Blog");
        $content->newBlock("BLOGLIST");
        while($blog = $get_blog->fetch(PDO::FETCH_ASSOC)){
            $content->newBlock("BLOGROW");
            $blog2 = $blog['Content'];
            if (strlen($blog2) > 100) {
                $blog2 = substr($blog['Content'], 0, 100) . "...";
            }
            $titel1 = $blog['Title'];
            if (strlen($titel1) > 30) {
                $titel1 = substr($blog['Title'], 0, 30) . "...";
            }
            $content->assign(array(
                "USERNAME"      => $blog['Username'],
                "ACCOUNTID"     => $blog['idAccounts'],
                "TITLE"         => $titel1,
                "CONTENT"       => $blog2,
                "IDBLOG"        => $blog['idBlog']
            ));


        }
    }
}





