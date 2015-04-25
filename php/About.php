<?php
$content = new TemplatePower("template/files/about.tpl");
$content->prepare();

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}else{
    $action = NULL;
}
switch($action){
    case"1":
        $content->newBlock("PAGEINFO");
        $content->newBlock("PAGE2");
        $content->newBlock("INTER");
        $content->newBlock("PAGES");
        $content->assign("PAGEUP", 2);
        $content->assign("PAGEDOWN", "#");
        break;
    case"2":
        $content->newBlock("PAGEINFO");
        $content->newBlock("PAGE3");
        $content->newBlock("WERK");
        $content->newBlock("PAGES");
        $content->assign("PAGEUP", 3);
        $content->assign("PAGEDOWN", 1);
        break;
    case"3":
        $content->newBlock("PAGEINFO");
        $content->newBlock("PAGE4");
        $content->newBlock("TOEKOMST");
        $content->newBlock("PAGES");
        $content->assign("PAGEUP", 4);
        $content->assign("PAGEDOWN", 2);
        break;
    case"4":
        $content->newBlock("PAGEINFO");
        $content->newBlock("PAGE5");
        $content->newBlock("CV");
        $content->newBlock("PAGES");
        $content->assign("PAGEUP", 5);
        $content->assign("PAGEDOWN", 3);
        break;
    case"5":
        $content->newBlock("PAGEINFO");
        $content->newBlock("PAGE6");
        $content->newBlock("GALA");
        $content->newBlock("PAGEND");
        $content->assign("PAGES", 4);
        break;
    default:
        $content->newBlock("PAGEINFO");
        $content->newBlock("PAGE1");
        $content->newBlock("ABOUT");
        $content->newBlock("PAGESTART");
        $content->assign("PAGEUP", 1);
}