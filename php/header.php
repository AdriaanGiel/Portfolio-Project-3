
<?php
// Hier laad ik de header.html in
$header = new TemplatePower("template/files/header.tpl");
$header->prepare();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}

if(isset ($_GET['pageid'])){
    if($_GET['pageid'] == 12){
        $header->newBlock("NAV");
        $header->assign("CLASS" ,"container-fluid");
        $header->newBlock("BODY2");
    }else{
        $header->newBlock("NAV");
        $header->assign("CLASS" ,"container");
        $header->newBlock("CONTA");
        $header->newBlock("BODY");
    }
}else{
    $header->newBlock("NAV");
    $header->assign("CLASS" ,"container");
    $header->newBlock("CONTA");
}


if(!empty($_SESSION['accountid'])){
    $header->newBlock("INGELOGD");
    $header->assign("USERNAME", $_SESSION['username']);

    if($_SESSION['roleid'] == 2){
        $header->newBlock("ADMINMENU");
    }
}else{
    if($action == "login"){
        $header->newBlock("LOGINFORMTOP");
        $header->assign("PAGE", $_GET['pageid']);

    }else{
        $header->newBlock("CHOICE");
        if(isset($_GET['pageid'])){
        $pageid = $_GET['pageid'];
        $header->assign("NUMMER", $pageid);
        }
    }
}



