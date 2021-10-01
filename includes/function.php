<?php
function main(){
    if (!isset($_REQUEST['page'])){
        include ('content/pages/main.md');
    }else{
        $page = $_REQUEST['page'];
        switch ($page){
            case 'about': include ('content/pages/about.md');break;
            case 'calc': include ('content/pages/calc.php');break;

            default: include ('content/pages/404.md');
        }
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