<?php
function getArticleList(){
    $dir    = 'content/blog/';
    $filesList = scandir($dir);
    dbg($filesList);
    $pages = glob($dir . "*.md");
    dbg($pages);
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
            case 'articles': articleList();break;
            default: include ('content/pages/404.md');
        }
    }
}
function app(){
    $uri = getURI();
    $page = parseURI($uri);
    switch ($page[0]){
        case 'about': include ('content/pages/about.md');break;
        case 'calc': include ('content/pages/calc.php');break;
        case 'articles': articleList();break;
        case 'page': showSinglePage($page);break;
        default: include ('content/pages/404.md');
    }

}
function articleList(){
    $path = 'content/blog/';
    $file_list = getFileList($path);
    foreach ( $file_list as $file){
        $page = getContent($path.$file);
        showIntroPage($page);
    }
}
function getFileList($path){
    $file_list =[];
    foreach(glob($path . '/*.md') as $dir) {
        if (is_file($dir)) { $file_list[] = basename($dir);}
    }
    return $file_list;
}
function getContent($path){
    $page = parseFile ($path);
    $pageItem['header'] =(array) json_decode ($page[0]);
    $pageItem['body'] = $page[1];
    return $pageItem;
}
function parseFile($path){
    $content = explode ( '===', getFileContent ($path));
    return $content;
}
function showIntroPage($page){
    echo '<article class="entry">
              <div class="entry-img">
                <img src="'.$page['header']['IntroImage'].'" alt="" class="img-fluid">
              </div>
              <h2 class="entry-title">
                <a href="/page/'.$page['header']['FileName'].'">'.$page['header']['Title'].'</a>
              </h2>

              <div class="entry-meta">
                <ul>
                  <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a href="blog-single.html">'.$page['header']['Autor'].'</a></li>
                  <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a href="blog-single.html"><time datetime="">'.$page['header']['Data'].'</time></a></li>                  
                </ul>
              </div>

              <div class="entry-content">
                '.$page['header']['Intro'].'
                <div class="read-more">
                  <a href="#">Read More</a>
                </div>
              </div>
            </article>';
}
function showSinglePage($page){
    require_once ('includes/Parsedown.php');
    $Parsedown = new Parsedown();
    $path = 'content/blog/';
    $file ='';
    if (empty($page[1])){
        include ('content/pages/404.md');
    }else{
        if (is_file($path.$page[1])) {
            $file = basename($path.$page[1]);
            dbg($file);
            $page = getContent($path.$file);
            echo '<article class="entry entry-single">';
            echo $Parsedown->text($page['body']);
            echo '</article>';
        }
    }

}
function getFileContent($path)
{
    return file_get_contents ($path);
}

function dbg($string){
    echo '<pre>';
    print_r ($string);
    echo '</pre>';
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
function getURI()
{
    return $_SERVER['REQUEST_URI'];
}
function parseURI($uri)
{
    $uri = trim ($uri,'/');
    $uri = explode ("/",$uri);
    return $uri;
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