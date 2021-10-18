<?php

namespace Core;

class CoreView
{
    public $twig;
    public $template;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('template/front/');
        $this->twig = new \Twig\Environment($loader, [
            //'cache' => '/path/to/compilation_cache',
        ]);
        $this->setTemplate();
    }

    /**
     * @param mixed $template
     */
    public function setTemplate($template = 'index.twig'): void
    {
        $this->template= $this->twig->load($template);
    }

}