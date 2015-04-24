<?php
if(isset($_SESSION['accountid'])){

}else{
    $content->newBlock("ERRORS");
    $content->assign("ERROR", "U bent niet ingelogd");

}

if($get_blog->fetchColumn() == 1){
    $content->newBlock("BLOGDETAIL");
    $uitkomst1 = $get_blog->fetch(PDO::FETCH_ASSOC);

    $content->assign(array(
        "USERNAME"  => $uitkomst1['Username'],
        "TITLE"     => $uitkomst1['Title'],
        "CONTENT"   => $uitkomst1['Content']
    ));


}else{
    $content->newBlock("ERRORS");
    $content->assign("ERROR", "ER Klopt iets niet");
}