<?php

namespace Core;

class FileClass
{
    public function articleList(){
        $path = 'content/blog/';
        $file_list = getFileList($path);
        foreach ( $file_list as $file){
            $page = getContent($path.$file);
            showIntroPage($page);
        }
    }
    public function getFileList($path){
        $file_list =[];
        foreach(glob($path . '/*.md') as $dir) {
            if (is_file($dir)) { $file_list[] = basename($dir);}
        }
        return $file_list;
    }
}