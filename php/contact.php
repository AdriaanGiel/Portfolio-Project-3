<?php
$content = new TemplatePower("template/files/contact.tpl");
$content->prepare();
if(isset($_GET['action'])) {
    if ($_GET['action'] == 1) {
        if (isset($_SESSION['accountid'])) {
            $get_email = $db->prepare("SELECT u.*
                                        FROM users u, accounts a
                                        WHERE a.idAccounts = :idaccount
                                        AND u.idUsers = a.Users_idUsers");
            $get_email->bindParam(":idaccount", $_SESSION['accountid']);
            $get_email->execute();

            $email = $get_email->fetch(PDO::FETCH_ASSOC);

            $content->newBlock("CONTACT");
            $content->assign(array(
                "VOORNAAM" => $email['Name'],
                "ACHTERNAAM" => $email['Surename'],
                "EMAIL" => $email['Email']
            ));
        } else {
            $content->newBlock("CONTACT");
        }

    }elseif($_GET['action'] == 2 ||!empty($_POST['voornaam'])||
        !empty($_POST['achternaam'])||
        !empty($_POST['email'])||
        !empty($_POST['onderwerp'])||
        !empty($_POST['bericht'])){

        //met test mail server
        $veremail = "a3aan_G@live.nl";
        $to      = $veremail;
        $subject = $_POST['onderwerp'];
        $message = $_POST['bericht'];
        $headers = 'Van:' . $_POST['email'] . "\r\n" .
            'Antwoorden naar:' . $_POST['email']  . "\r\n" ;

        mail($to, $subject, $message, $headers);

        $content->newBlock("MELDING");
        $content->assign("MELDING", "Bedankt voor uw bericht");

    }
}else {
    $content->newBlock("INFO");
}

