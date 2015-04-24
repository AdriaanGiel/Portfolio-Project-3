<?php
$content = new TemplatePower("template/files/admin_projecten.tpl");
$content->prepare();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}

switch($action){
    case"toevoegen";
        if(!empty($_POST['projectnaam']) && !empty($_POST['projectpost'])){
            try{
                $insert_project = $db->prepare("INSERT INTO products
                                                SET
                                                Title   = :titel,
                                                Content = :content,
                                                Accounts_idAccounts = :idaccount");
                $insert_project->bindParam(":titel", $_POST['projectnaam']);
                $insert_project->bindParam(":content", $_POST['projectpost']);
                //$insert_project->bindParam(":projectid", $_POST['projectid']);
                $insert_project->bindParam(":idaccount", $_SESSION['accountid']);
                $insert_project->execute();

                $content->newBlock("MELDING");
                $content->assign("MELDING", "Project is toegevoegd");


            }catch(PDOException $error){

                $errors->newBlock("ERRORS");
                $errors->assign("ERROR", "er is een error bij het toevoegen: ".$error->getFile()." ".$error->getLine());
            }
        }else{
            $content->newBlock("PROJECTFORM");
            $content->assign("ACTION", "index.php?pageid=6&action=toevoegen");
            $content->assign("BUTTON", "Toevoegen Project");

        }
        break;
    case"wijzigen";
        if(isset($_GET['projectid'])){
            // ophalen project
            $check_project = $db->prepare("SELECT count(*) FROM
                                                    accounts a, products p
                                                    WHERE a.idAccounts = p.Accounts_idAccounts
                                                    AND p.idProducts = :projectid");
            $check_project->bindParam(":projectid", $_GET['projectid']);
            $check_project->execute();

            if($check_project->fetchColumn() == 1){
                // hij bestaat in db
                $get_project = $db->prepare("SELECT * FROM
                                                    accounts a, products p
                                                    WHERE a.idAccounts = p.Accounts_idAccounts
                                                    AND p.idProducts = :projectid");
                $get_project->bindParam(":projectid", $_GET['projectid']);
                $get_project->execute();

                $project = $get_project->fetch(PDO::FETCH_ASSOC);

                $content->newBlock("PROJECTFORM");
                $content->assign(array(
                    "TITEL" => $project['Title'],
                    "CONTENT" => $project['Content'],
                    "PROJECTID" => $project['idProducts'],
                    "ACTION" => "index.php?pageid=6&action=wijzigen",
                    "BUTTON" => "Wijzigen Project"
                ));
            }else{
                $errors->newBlock("ERRORS");
                $errors->assign("ERROR", "Waarom heb je het projectid in de url veranderd???");
            }
        }elseif(!empty($_POST['projectnaam'])
            AND !empty($_POST['projectpost'])
            AND !empty($_POST['projectid'])){

            $update = $db->prepare("UPDATE products
                                    SET Title = :title,
                                        Content = :content
                                    WHERE idProducts = :projectid");
            $update->bindParam(":title", $_POST['projectnaam']);
            $update->bindParam(":content", $_POST['projectpost']);
            $update->bindParam(":projectid", $_POST['projectid']);
            $update->execute();

            $content->newBlock("MELDING");
            $content->assign("MELDING", "Project gewijzigd");
        }else{
            $errors->newBlock("ERRORS");
            $errors->assign("ERROR", "WTF doe je hier");
        }
        break;
    case"verwijderen";
        if(isset($_GET['projectid'])){
            // formulier laten zien
            $check_project = $db->prepare("SELECT count(*)
                                            FROM products
                                            WHERE idProducts = :productid");
            $check_project->bindParam(":productid", $_GET['projectid']);
            $check_project->execute();
            // check of er 1 rij is
            if($check_project->fetchColumn() == 1){
                // hij bestaat
                // nu eerst gegevens ophalen
                $get_project = $db->prepare("SELECT *
                                              FROM products
                                              WHERE idProducts = :productid");
                $get_project->bindParam(":productid", $_GET['projectid']);
                $get_project->execute();

                $project = $get_project->fetch(PDO::FETCH_ASSOC);

                $content->newBlock("PROJECTFORM");
                $content->assign(array(
                    "TITEL" => $project['Title'],
                    "CONTENT" => $project['Content'],
                    "PROJECTID" => $project['idProducts'],
                    "ACTION" => "index.php?pageid=6&action=verwijderen",
                    "BUTTON" => "Verwijder project"
                ));
            }else
            {
                $errors->newBlock("ERRORS");
                $errors->assign("ERROR", "Item bestaat niet");
            }
        }elseif(isset($_POST['projectid'])){
            // item verwijderen
            $check_project = $db->prepare("SELECT count(*) FROM products
                                            WHERE idProducts = :productid");
            $check_project->bindParam(":productid", $_POST['projectid']);
            $check_project->execute();
            // check of er 1 rij is
            if($check_project->fetchColumn() == 1) {
                // item verwijderen
                $delete_project = $db->prepare("DELETE FROM products WHERE idProducts = :projectid");
                $delete_project->bindParam(":projectid", $_POST['projectid']);
                $delete_project->execute();

                $content->newBlock("MELDING");
                $content->assign("MELDING", "Project verwijderd");
            }else{
                // error, is niet in de db
                $errors->newBlock("ERRORS");
                $errors->assign("ERROR", "Dit item kan niet meer worden verwijderd, want het staat niet in de DB");
            }
        }else{
            // ERROR !!
            $errors->newBlock("ERRORS");
            $errors->assign("ERROR", "WTF doe je hier");
        }
        break;
    default:
        if (!empty($_POST['search'])) {
            $get_projects = $db->prepare("SELECT a.Username,
                                                a.Role_idRole,
                                                a.idAccounts,
                                                p.Title,
                                                p.Content,
                                                p.idProducts,
                                                p.Accounts_idAccounts
                                          FROM accounts a, products p
                                          WHERE p.Accounts_idAccounts = a.idAccounts
                                          AND (a.Username LIKE :search
                                          OR p.Title LIKE :search2)
                                          ");
            $search = "%" . $_POST['search'] . "%";
            $get_projects->bindParam(":search", $search);
            $get_projects->bindParam(":search2", $search);
            $get_projects->execute();

            $content->assign("SEARCH", $_POST['search']);
        }else{
            $check_project = $db->query("SELECT * FROM products
                                    ");
            if($check_project->fetchColumn() > 0) {
                try{
                    $get_projects = $db->query("SELECT
                                                p.Title,
                                                p.Content,
                                                p.idProducts,
                                                a.Username,
                                                a.idAccounts
                                                FROM
                                                products p,
                                                accounts a
                                                WHERE p.Accounts_idAccounts = a.idAccounts");
                }catch(PDOException $error){
                    $errors->newBlock("ERRORS");
                    $errors->assign("ERROR", "er is een error: ".$error->getFile()." ".$error->getLine());
                }
            }else{
                $errors->newBlock("ERRORS");
                $errors->assign("Er Zijn Geen Projecten");
            }
        }
            $content->newBlock("PROJECTLIST");

            while($result = $get_projects->fetch(PDO::FETCH_ASSOC)){
                $inhoud = $result['Content'];
                if (strlen($inhoud) > 25) {
                    $inhoud = substr($result['Content'], 0, 25) . "...";
                }
                $content->newBlock("PROJECTROW");
                $content->assign(array(
                    "TITLE"     => $result['Title'],
                    "USERNAME"  => $result['Username'],
                    "CONTENT"   => $inhoud,
                    "PROJECTID" => $result['idProducts'],
                    "ACCOUNTID" => $result['idAccounts'],
                ));
            }


}
