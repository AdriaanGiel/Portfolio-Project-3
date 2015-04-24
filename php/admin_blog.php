<?php
$content = new TemplatePower("template/files/admin_blog.tpl");
$content->prepare();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}
if(isset($_SESSION['roleid'])) {
    if ($_SESSION['roleid'] == 2) {
        switch ($action) {
            case "toevoegen":
                if (!empty($_POST['blognaam']) && !empty($_POST['blogpost'])) {
                    $insert_blog = $db->prepare("INSERT INTO blog SET
                                                    Title   = :blognaam,
                                                    Content = :blogpost,
                                                    Accounts_idAccounts = :idaccount");
                    $insert_blog->bindParam(":blognaam", $_POST['blognaam']);
                    $insert_blog->bindParam(":blogpost", $_POST['blogpost']);
                    $insert_blog->bindParam(":idaccount", $_SESSION['accountid']);
                    $insert_blog->execute();

                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Blog is toegevoegd");

                } else {
                    // formulier
                    $content->newBlock("FBLOG");
                    $content->assign("ACTION", "index.php?pageid=3&action=toevoegen");
                    $content->assign("BUTTON", "Toevoegen Blog");
                }
                break;
            case "wijzigen":
                if(isset($_GET['blogid'])){
                        if ($_SESSION['roleid'] == 2) {
                            try{
                                $get_blog = $db->prepare("SELECT
                                              b.Title,
                                              b.Content,
                                              b.idBlog,
                                              a.Username,
                                              a.idAccounts
                                              FROM blog b, accounts a
                                              WHERE b.idBlog = :idblog");
                                $get_blog->bindParam(":idblog", $_GET['blogid']);
                                $get_blog->execute();

                            }catch (PDOException $error){
                                $content->newBlock("ERRORS");
                                $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
                            }


                            $blog = $get_blog->fetch(PDO::FETCH_ASSOC);

                            $content->newBlock("FBLOG");
                            $content->assign("ACTION", "index.php?pageid=3&action=wijzigen");
                            $content->assign("BUTTON", "Wijzigen Blog");

                            $content->assign(array(
                                "TITEL" => $blog['Title'],
                                "CONTENT" => $blog['Content'],
                                "USERNAME" => $blog['Username'],
                                "ACCOUNTID" => $blog['idAccounts'],
                                "IDBLOG" => $blog['idBlog']
                            ));
                        } else {
                            $content->newBlock("ERRORS");
                            $content->assign("ERROR", "DIT IS EEN ANDER ADMIN USER POST");
                        }

                }elseif (isset($_POST['blogid'])) {
                    if (!empty($_POST['blognaam']) && !empty($_POST['blogpost'])) {
                        try {
                            $update_blog = $db->prepare("UPDATE blog
                                                          SET Title = :blognaam,
                                                              Content = :blogpost
                                                          WHERE blog.idBlog = :idblog");
                            $update_blog->bindParam(":blognaam", $_POST['blognaam']);
                            $update_blog->bindParam(":blogpost", $_POST['blogpost']);
                            //$update_blog->bindValue(":accountid", $_SESSION['accountid']);
                            $update_blog->bindParam(":idblog", $_POST['blogid']);
                            $update_blog->execute();

                            $content->newBlock("MELDING");
                            $content->assign("MELDING", "Blog is Gewijzigd");

                        }catch (PDOException $error){
                            $content->newBlock("ERRORS");
                            $content->assign("ERROR", $error->getFile(). $error->getLine(). $error->getMessage());
                        }

                    }else{
                        $content->newBlock("ERRORS");
                        $content->assign("ERROR", "ER IS IETS FOUT GEGAAN");

                    }
                }else{
                    $content->newBlock("ERRORS");
                    $content->assign("ERROR", "ER IS IETS FOUT GEGAAN BIJ STAP 1");
                }

                break;
            case "verwijderen":
                if (isset($_GET['blogid'])) {
                    if ($_SESSION['roleid'] == 2) {
                        $get_blog = $db->prepare("SELECT
                                              b.Title,
                                              b.Content,
                                              b.idBlog,
                                              a.idAccounts,
                                              a.Username
                                              FROM blog b, accounts a
                                              WHERE b.idBlog = :idblog");
                        $get_blog->bindParam(":idblog", $_GET['blogid']);
                        //$get_blog->bindParam(":idaccount", $_SESSION['accountid']);
                        $get_blog->execute();

                        $blog = $get_blog->fetch(PDO::FETCH_ASSOC);

                        $content->newBlock("FBLOG");
                        $content->assign(array(
                            "TITEL" => $blog['Title'],
                            "CONTENT" => $blog['Content'],
                            "USERNAME" => $blog['Username'],
                            "ACCOUNTID" => $blog['idAccounts'],
                            "IDBLOG" => $blog['idBlog'],
                            "ACTION" => "index.php?pageid=3&action=verwijderen",
                            "BUTTON" => "Verwijder Blog"
                        ));
                    } else {
                        $content->newBlock("ERRORS");
                        $content->assign("ERROR", "KAN GEEN ANDER ADMIN GEBRUIKER POST VERWIJDEREN");
                    }

                } elseif (isset($_POST['blogid'])) {
                    $delete_blog = $db->prepare("DELETE FROM blog
                                                 WHERE idBlog = :idblog");
                    $delete_blog->bindParam(":idblog", $_POST['blogid']);
                    $delete_blog->execute();

                    $content->newBlock("MELDING");
                    $content->assign("MELDING", "Blog is Verwijderd");
                } else {
                    $content->newBlock("ERRORS");
                    $content->assign("ERROR", "ER IS IETS FOUT GEGAAN");
                }
                break;

            default:
                if (!empty($_POST['search'])) {
                    $get_blogs = $db->prepare("SELECT a.Username,
                                                a.Role_idRole,
                                                a.idAccounts,
                                                b.Title,
                                                b.Content,
                                                b.idBlog,
                                                b.Accounts_idAccounts
                                          FROM accounts a, blog b
                                          WHERE b.Accounts_idAccounts = a.idAccounts
                                          AND (a.Username LIKE :search
                                          OR b.Title LIKE :search2)
                                          ");
                    $search = "%" . $_POST['search'] . "%";
                    $get_blogs->bindParam(":search", $search);
                    $get_blogs->bindParam(":search2", $search);
                    $get_blogs->execute();
                    $content->assign("SEARCH", $_POST['search']);
                } else {
                    $get_blogs = $db->query("SELECT a.Role_idRole,
                                                a.Username,
                                                a.idAccounts,
                                                b.Title,
                                                b.Content,
                                                b.idBlog
                                          FROM accounts a, blog b
                                          WHERE b.Accounts_idAccounts = a.idAccounts
                                          ");
                }
                $content->newBlock("BLOGLIST");
                while ($blog1 = $get_blogs->fetch(PDO::FETCH_ASSOC)) {
                    $titel1 = $blog1['Title'];
                    if (strlen($titel1) > 10) {
                        $titel1 = substr($blog1['Title'], 0, 10) . "...";
                    }
                    $inhoud = $blog1['Content'];
                    if (strlen($inhoud) > 25) {
                        $inhoud = substr($blog1['Content'], 0, 25) . "...";
                    }
                    $content->newBlock("BLOGROW");
                    $content->assign(array(
                        "USERNAME" => $blog1['Username'],
                        "IDROLE" => $blog1['Role_idRole'],
                        "ACCOUNTID" => $blog1['idAccounts'],
                        "TITLE" => $titel1,
                        "CONTENT" => $inhoud,
                        "IDBLOG" => $blog1['idBlog']

                    ));


                }

        }
    }else{
        $content->newBlock("ERRORS");
        $content->assign("ERROR", "GEEN ADMIN BEVOEGDHEDEN");

    }
}else{
    $content->newBlock("ERRORS");
    $content->assign("ERROR", "U bent niet ingelogd");
}