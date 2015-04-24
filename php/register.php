<?php
$content = new TemplatePower("template/files/register.tpl");
$content->prepare();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}

if(!empty($_POST['vnaam'])
    && !empty($_POST['anaam'])
    && !empty($_POST['gnaam'])
    && !empty($_POST['email'])
    && !empty($_POST['password1'])
    && !empty($_POST['password2'])){
    // insert
    if($_POST['password1'] == $_POST['password2'])
    {
        // insert
        $insert_user = $db->prepare("INSERT INTO users SET
                  Surename = :anaam,
                  Name = :vnaam,
                  Email = :email");
        $insert_user->bindParam(":anaam", $_POST['anaam']);
        $insert_user->bindParam(":vnaam", $_POST['vnaam']);
        $insert_user->bindParam(":email", $_POST['email']);
        $insert_user->execute();

        $userid = $db->lastInsertId();

        $insert_account = $db->prepare("INSERT INTO accounts SET
                  Username = :username,
                  Password = :password,
                  Users_idUsers = :userid,
                  Role_idRole = :roleid");
        $insert_account->bindParam(":username", $_POST['gnaam']);

        $options = [
            'cost' => 12,
        ];
        $password = password_hash($_POST['password1'], PASSWORD_BCRYPT, $options);

        $insert_account->bindParam(":password", $password);
        $insert_account->bindParam(":userid", $userid);
        $insert_account->bindValue(":roleid", 1);
        $insert_account->execute();

        $content->newBlock("MELDING");
        $content->assign("MELDING", "Je bent geregistreerd");


    }else{
        $errors->newBlock("ERRORS");
        $errors->assign("ERROR", "Wachtwoord komt niet overeen");
        $content->newBlock("USERFORM");
        $content->assign("ACTION", "index.php?pageid=2&action=toevoegen");
        $content->assign("BUTTON", "Toevoegen Gebruiker");
    }
    }else{
    // formulier
    $content->newBlock("USERFORM");
    $content->assign("ACTION", "index.php?pageid=8&action=toevoegen");
    $content->assign("BUTTON", "Register");
}