<?php
include_once('include/function.php');

$content = new TemplatePower("template/files/vergeten.tpl");
$content->prepare();

if(isset($_GET['action'])){
    $action = $_GET['action'];
}else{
    $action = NULL;
}


if(!isset($_SESSION['accountid'])){
    switch($action){
        case "1":
            $content->newBlock("VERGETENFORM");
            $content->assign("OPTION", $_GET['option']);
            break;
        case "2":
            if(!empty($_POST['email'])){
                if(isset($_POST['option'])){
                    // welke option hebben we.

                    if($_POST['option'] == 1){
                        // option 1: sturen we username
                        try{
                            $check_account = $db->prepare("SELECT count(u.idUsers)
                                                            FROM users u, accounts a
                                                            WHERE u.Email = :email
                                                            AND u.idUsers = a.Users_idUsers");
                            $check_account->bindParam(":email", $_POST['email']);
                            $check_account->execute();

                        }catch (PDOException $error){
                            $errors->newBlock("ERRORS");
                            $errors->assign("ERROR", "er is een error: ".$error->getFile()." ".$error->getLine());
                        }

                        if($check_account->fetchColumn() == 1){

                            try{
                                $get_account = $db->prepare("SELECT u.Email, a.Username
                                                              FROM users u, accounts a
                                                              WHERE u.Email = :email
                                                              AND u.idUsers = a.Users_idUsers");
                                $get_account->bindParam(":email", $_POST['email']);
                                $get_account->execute();

                            }catch (PDOException $error){
                                $errors->newBlock("ERRORS");
                                $errors->assign("ERROR", "er is een error: ".$error->getFile()." ".$error->getLine());
                            }

                            $user = $get_account->fetch(PDO::FETCH_ASSOC);

                            /*$admin_mail = "portfolio@gmail.com";
                            $mail_onderwerp = "Username vergeten";
                            $naam = $user['Username'];
                            $email = $user['Email'];
                            $headers = "Van $admin_mail \r\n";

                            $email_body = "Uw username is: $naam";

                            mail($email , $mail_onderwerp , $email_body , $header);*/

                            //Werkt met test mail server
                            $to      = $user['Email'];
                            $subject = 'Username vergeten';
                            $message = 'Uw username is: '. $user['Username'];
                            $headers = 'From: portfolio@gmail.com' . "\r\n" .
                                'Reply-To: portfolio@gmail.com' . "\r\n" ;

                            mail($to, $subject, $message, $headers);

                            $content->newBlock("MELDING");
                            $content->assign("MELDING", "Er is een bericht verstuurd naar uw e-mail");

                        }
                    }


                    elseif($_POST['option'] == 2){
                        // option2 : zetten we een hash in de db


                        // account verkrijgen
                        $check_account = $db->prepare("SELECT count(u.idUsers)
                                                        FROM users u, accounts a
                                                        WHERE u.Email = :email
                                                        AND u.idUsers = a.Users_idUsers");
                        $check_account->bindParam(":email", $_POST['email']);
                        $check_account->execute();

                        if($check_account->fetchColumn() == 1){
                            // gebruiker gevonden
                            $get_account = $db->prepare("SELECT a.*, u.*
                                                          FROM users u, accounts a
                                                          WHERE u.Email = :email
                                                          AND u.idUsers = a.Users_idUsers");
                            $get_account->bindParam(":email", $_POST['email']);
                            $get_account->execute();

                            $account = $get_account->fetch(PDO::FETCH_ASSOC);

                            $hash = hashgenerator();
                            $insert_hash = $db->prepare("UPDATE accounts
                                                          SET Reset = :hash
                                                          WHERE idAccounts = :accountid ");
                            $insert_hash->bindParam(":hash", $hash);
                            $insert_hash->bindParam(":accountid", $account['idAccounts']);
                            $insert_hash->execute();
                        }else{
                            // er is geen gebruiker met dat mail adres
                        }


                        // mail sturen met link
                        try{
                            $get_hash = $db->prepare("SELECT a.Reset, u.*
                                                  FROM accounts a, users u
                                                  WHERE u.Email = :email
                                                  AND u.idUsers = a.Users_idUsers");
                            $get_hash->bindParam(":email", $_POST['email']);
                            $get_hash->execute();

                        }catch (PDOException $error){
                            $errors->newBlock("ERRORS");
                            $errors->assign("ERROR", "er is een error: ".$error->getFile()." ".$error->getLine());
                        }


                        $ehash = $get_hash->fetch(PDO::FETCH_ASSOC);
                        //Werkt met test mail server
                        $to      = $ehash['Email'];
                        $subject = 'Wachtwoord reset';
                        $message = 'http://127.0.0.1/php/Portfolio%20Project%203/index.php?pageid=11&action=3&code='. $ehash['Reset'];
                        $headers = 'From: portfolio@gmail.com' . "\r\n" .
                            'Reply-To: portfolio@gmail.com' . "\r\n" ;

                        mail($to, $subject, $message, $headers);

                        $content->newBlock("MELDING");
                        $content->assign("MELDING", "Er is een link verstuurd naar uw e-mail waarmee u uw wachtwoord kan resetten");



                    }elseif($_POST['option'] == 3) {
                        // option 3: sturen we username
                        try{
                            $check_account = $db->prepare("SELECT count(u.idUsers)
                                                            FROM users u, accounts a
                                                            WHERE u.Email = :email
                                                            AND u.idUsers = a.Users_idUsers");
                            $check_account->bindParam(":email", $_POST['email']);
                            $check_account->execute();

                        }catch (PDOException $error){
                            $errors->newBlock("ERRORS");
                            $errors->assign("ERROR", "er is een error: ".$error->getFile()." ".$error->getLine());
                        }

                        if($check_account->fetchColumn() == 1){

                            try{
                                $get_account = $db->prepare("SELECT u.Email, a.Username, a.idAccounts
                                                              FROM users u, accounts a
                                                              WHERE u.Email = :email
                                                              AND u.idUsers = a.Users_idUsers");
                                $get_account->bindParam(":email", $_POST['email']);
                                $get_account->execute();

                            }catch (PDOException $error){
                                $errors->newBlock("ERRORS");
                                $errors->assign("ERROR", "er is een error: ".$error->getFile()." ".$error->getLine());
                            }

                            $user = $get_account->fetch(PDO::FETCH_ASSOC);

                            $hash = hashgenerator();
                            $insert_hash = $db->prepare("UPDATE accounts
                                                          SET Reset = :hash
                                                          WHERE idAccounts = :accountid ");
                            $insert_hash->bindParam(":hash", $hash);
                            $insert_hash->bindParam(":accountid", $user['idAccounts']);
                            $insert_hash->execute();


                            try{
                                $get_hash = $db->prepare("SELECT a.Reset, u.*
                                                  FROM accounts a, users u
                                                  WHERE u.Email = :email
                                                  AND u.idUsers = a.Users_idUsers");
                                $get_hash->bindParam(":email", $_POST['email']);
                                $get_hash->execute();

                            }catch (PDOException $error){
                                $errors->newBlock("ERRORS");
                                $errors->assign("ERROR", "er is een error: ".$error->getFile()." ".$error->getLine());
                            }

                            $ehash = $get_hash->fetch(PDO::FETCH_ASSOC);
                            /*$admin_mail = "portfolio@gmail.com";
                            $mail_onderwerp = "Username vergeten";
                            $naam = $user['Username'];
                            $email = $user['Email'];
                            $headers = "Van $admin_mail \r\n";

                            $email_body = "Uw username is: $naam";

                            mail($email , $mail_onderwerp , $email_body , $header);*/

                            //Werkt met test mail server
                            $to      = $user['Email'];
                            $subject = 'Username vergeten';
                            $message = 'Uw username is: '. $user['Username']. "\r\n" .
                            'Dit is uw wachtwoord reset link ' . 'http://127.0.0.1/php/Portfolio%20Project%203/index.php?pageid=11&action=3&code='. $ehash['Reset'];
                            $headers = 'From: portfolio@gmail.com' . "\r\n" .
                                'Reply-To: portfolio@gmail.com' . "\r\n" ;

                            mail($to, $subject, $message, $headers);

                            $content->newBlock("MELDING");
                            $content->assign("MELDING", "Er is een bericht verstuurd naar uw e-mail");

                        }
                        //             zetten we een hash in de db
                        // mail sturen met link
                    }else{
                        // error
                    }

                    // mail sturen
                }else{

                }

            }

            break;
        case "3":
            if(isset($_GET['code'])) {
                try {
                    $check_hash = $db->prepare("SELECT count(*)
                                            FROM accounts a
                                            WHERE a.Reset = :ehash");
                    $check_hash->bindParam(":ehash", $_GET['code']);
                    $check_hash->execute();

                } catch (PDOException $error) {
                    $errors->newBlock("ERRORS");
                    $errors->assign("ERROR", "er is een error: " . $error->getFile() . " " . $error->getLine());
                }

                if ($check_hash->fetchColumn() == 1) {

                    $content->newBlock("PASSWORD");
                    $content->assign("CODE", $_GET['code']);
                    $content->assign("ACTION", 3);
                } else {
                    $errors->newBlock("ERRORS");
                    $errors->assign("ERROR", "Deze link klopt niet");
                }
            }

                if (!empty($_POST['password'])
                        and !empty($_POST['code']) ) {
                        if ($_POST['password'] == $_POST['password2']) {

                            $options = [
                                'cost' => 12,
                            ];
                            $password = password_hash($_POST['password'], PASSWORD_BCRYPT, $options);

                            try {
                                $reset_password = $db->prepare("UPDATE accounts
                                                                SET Password = :wachtwoord,
                                                                    Reset = NULL
                                                                WHERE accounts.Reset = :ehash");
                                $reset_password->bindParam(":wachtwoord", $password);
                                $reset_password->bindParam(":ehash", $_POST['code']);
                                $reset_password->execute();


                            } catch (PDOException $error) {
                                $errors->newBlock("ERRORS");
                                $errors->assign("ERROR", "er is een error: " . $error->getFile() . " " . $error->getLine());
                            }

                            $content->newBlock("MELDING");
                            $content->assign("MELDING", "Uw wachtwoord is nu gereset");
                        } else {
                            $content->newBlock("ERRORS");
                            $content->assign("ERROR", "Wachtwoord komt niet overeen");
                        }
                    }
            break;
        default:


    }

}else{
    $content->newBlock("ERRORS");
    $content->assign("ERROR", "Je bent al ingelogd");
}


