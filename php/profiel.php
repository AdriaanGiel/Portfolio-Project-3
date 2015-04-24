<?php
$content = new TemplatePower("template/files/profiel.tpl");
$content->prepare();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}

try{
    $get_blog = $db->prepare("SELECT b.idBlog,
                                      a.Username,
                                      b.Title,
                                      b.Content
                                FROM blog b, accounts a
                                WHERE b.idBlog = :idblog ");
    $get_blog->bindParam(":idblog", $_GET['blogid']);
    $get_blog->execute();

}catch (PDOException $error){
    $errors->newBlock("ERRORS");
    $errors->assign("ERROR", "er is een error: ".$error->getFile()." ".$error->getLine());
}

if($get_blog->fetchColumn() == 1){

}
