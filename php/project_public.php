<?php
$content = new TemplatePower("template/files/project_public.tpl");
$content->prepare();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}

    if(isset($_GET['projectid'])){
        // controleren of alles er is
        $content->newBlock("DETAILS");
        $check_project = $db->prepare("SELECT count(*) FROM products
                                      WHERE idProducts = :projectid");
        $check_project->bindParam(":projectid", $_GET['projectid']);
        $check_project->execute();

        if($check_project->fetchColumn() == 1){

            $get_project = $db->prepare("SELECT p.*, a.Username
                                          FROM products p, accounts a
                                          WHERE p.idProducts = :projectid
                                          AND p.Accounts_idAccounts = a.idAccounts");
            $get_project->bindParam(":projectid", $_GET['projectid']);
            $get_project->execute();

            $project = $get_project->fetch(PDO::FETCH_ASSOC);

            $content->assign(array(
                "TITLE" => $project['Title'],
                "CONTENT" => $project['Content'],
                "IMAGE" => $project['images'],
                "USERNAME" => $project['Username']));

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
                                            "IDPROJECT" => $_GET['projectid']
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
                                                "IDPROJECT"    => $comment['Products_idProducts']

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
                                            "IDPROJECT" => $_GET['projectid']
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
                                                "IDPROJECT"    => $comment['Products_idProducts']
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
                            $content->assign("IDPROJECT", $_GET['projectid']);
                        }

                    }else{
                        $content->newBlock("COMMENTFORM");
                        $content->assign("IDPROJECT", $_GET['projectid']);
                    }
                }
                if(!empty($_POST['comment'])){
                    try{
                        $insert_comment = $db->prepare("INSERT INTO comments SET
                                                    Text = :com,
                                                    Products_idProducts = :idproject,
                                                    Accounts_idAccounts = :accountid");
                        $insert_comment->bindParam(":com",$_POST['comment']);
                        $insert_comment->bindParam(":idproject",$_POST['idproject']);
                        $insert_comment->bindParam(":accountid", $_SESSION['accountid']);
                        $insert_comment->execute();

                        $content->newBlock("MELDING");
                        $content->assign(array(
                            "MELDING"   => "COMMENT IS TOEGEVOEGT",
                            "IDPROJECT" => $_GET['projectid']
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
                                            WHERE Products_idProducts = :idproject");
            $check_comments->bindParam(":idproject", $_GET['projectid']);
            $check_comments->execute();

            if($check_comments->fetchColumn() > 0){
                try{
                    $get_comments = $db->prepare("SELECT comments.*, accounts.Username
                                                  FROM comments, accounts
                                                  WHERE comments.Products_idProducts = :idproject
                                                  AND comments.Accounts_idAccounts = accounts.idAccounts");
                    $get_comments->bindParam(":idproject", $_GET['projectid']);
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
                        "IDPROJECT" => $comments['Products_idProducts'],
                        "COMMENTID" => $comments['idComments']
                    ));
                    if(isset($_SESSION['roleid'])){
                        if($_SESSION['roleid'] == 2){
                            //if wijzigen
                            //elsif verwijderen
                            //else V
                            $content->newBlock("COMMENTAMDMIN");
                            $content->assign("IDPROJECT",$comments['Products_idProducts']);
                            $content->assign("COMMENTID", $comments['idComments']);
                        }
                    }
                }
            }

        }else{
                // error
        }

    }else{
        $check_projects = $db->query("SELECT count(*) FROM products");

        if($check_projects->fetchColumn() > 0 ){

            $get_projects = $db->query("SELECT * FROM products");
            $teller = 0;

            while($projects = $get_projects->fetch(PDO::FETCH_ASSOC)){
                $teller++;
                if($teller % 3 == 1){
                    // div openen
                    $content->newBlock("BEGIN");
                }
                    // block van een element oproepen
                $projectcontent = substr($projects['Content'], 0, 80)." ...";
                $content->newBlock("PROJECT");
                $content->assign(array(
                    "TITLE" => $projects['Title'],
                    "CONTENT" => $projectcontent,
                    "IMAGE" => $projects['images'],
                    "PROJECTID" => $projects['idProducts']));

                if($teller % 3 == 0){
                    // div sluiten
                    $content->newBlock("END");
                }
            }
        }else{
    // geen projecten gevonden
        }
    }