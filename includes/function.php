<?php
function dd($some){
    echo '<pre>';
    print_r($some);
    echo '</pre>';

};
function getArticleList(){
    $dir    = 'content/pages/';
    $filesList = scandir($dir);
    dd($filesList);
    $pages = glob($dir . "*.md");
    dd($pages);
    foreach($pages as $page) {
        $pageName = substr($page, 8);
        $pageName = substr($pageName, 0, -3);
        echo "<li><a href=\"index.php?id=".$pageName."\">".$pageName."</a></li>";

    }

};
function main(){
    if (!isset($_REQUEST['page'])){
        include ('content/pages/main.md');
    }else{
        $page = $_REQUEST['page'];
        switch ($page){
            case 'about': include ('content/pages/about.md');break;
            case 'calc': include ('content/pages/calc.php');break;
            case 'article': getArticleList();break;

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