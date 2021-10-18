<?php

namespace App;

class BlogClass
{


    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('template/front/');
        $this->twig = new \Twig\Environment($loader, [
            //'cache' => '/path/to/compilation_cache',
        ]);
         $this->template= $this->twig->load('index.twig');
    }

    public function index($title = 'Twig ))')
    {
        echo $this->template->render(['Title' => $title]);


    }
}