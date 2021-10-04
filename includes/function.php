<?php

function main(){
    if (!isset($_REQUEST['page'])){
        include ('content/pages/main.md');
    }else{
        $page = $_REQUEST['page'];
        switch ($page){
            case 'about': include ('content/pages/about.md');break;
            case 'calc': include ('content/pages/calc.php');break;
            case 'articles': articleList();break;
            default: include ('content/pages/404.md');
        }
    }
}
function articleList(){
    $path = 'content/blog/';
    $file_list = getFileList($path);
    foreach ( $file_list as $file){
        $page = getContent($path.$file);
        dbg($page);
    }
}

function getDirList($path)
{
    $dir_list=[];
    foreach(glob($path . '/*', GLOB_ONLYDIR) as $dir) {
        if (   ($dir)) {
            $dir_list[] = basename($dir);
        }
    }
    return $dir_list;
}

function getFileList($path)
{
    $file_list =[];
    foreach(glob($path . '/*.md') as $dir) {
        if (is_file($dir)) {
            $file_list[] = basename($dir);
        }
    }
    return $file_list;
}

function getContent($path)
{
    $page = parseFile ($path);
    $pageItem['header'] =(array) json_decode ($page[0]);
    $pageItem['body'] = $page[1];
    return $pageItem;
}

function dbg($string){
    echo '<pre>';
    print_r ($string);
    echo '</pre>';
}

function GetURI()
{
    return $_SERVER['REQUEST_URI'];
}

function ParseURI($uri)
{
    $uri = trim ($uri,'/');
    $uri = explode ("/",$uri);
    return $uri;
}

function getFileContent($path)
{
    return file_get_contents ($path);
}

function parseFile($path)
{
    $content = explode ( '===', getFileContent ($path));
    return $content;
}

function calc(){
    if(isset($_POST['btnCalc'])){
        $message = "нечего считать(((";
        if (isset($_POST['a']) && !empty($_POST['a']))
        {
            $a = $_POST['a'];
        };
        if (isset($_POST['b']) && !empty($_POST['b']))
        {
            $b = $_POST['b'];
        };
        if (isset($_POST['action']) && !empty($_POST['action']))
        {
            $action = $_POST['action'];
        };
        switch ($action){
            case '-':
                $message = "$a - $b= ";
                $message .= $a-$b;
                break;
            case '+': $message = "$a + $b= ";$message .=  $a+$b;break;
            case '/': $message = "$a / $b= ";$message .=  $a/$b;break;
            case '*': $message = "$a * $b= ";$message .=  $a*$b;break;
            default: $message = "WTF? ";
        }
    }
    return $message;
}
?>