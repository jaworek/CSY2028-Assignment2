<?php

namespace Cars\Controllers;

use DirectoryIterator;
use PDO;

class Banner
{
    public function loadBanner()
    {
        $files = [];
        foreach (new DirectoryIterator('./images/banners') as $file) {
            if ($file->isDot()) {
                continue;
            }

            if (!strpos($file->getFileName(), '.jpg')) {
                continue;
            }

            $files[] = $file->getFileName();
        }

//        header('content-type: image/jpeg');

        $contents = $this->loadFile('./images/banners/' . $files[rand(0, count($files) - 1)]);

//        header("Cache-Control: no-store, no-cache, must-revalidate");
//        header("Cache-Control: post-check=0, pre-check=0", false);
//        header("Pragma: no-cache");
//        header('content-length: ' . strlen($contents));

//        return $contents;
    }

    public function loadFile($name)
    {
        //Loads a files contents and returns it
        ob_start();
        include($name);
        $contents = ob_get_clean();
        return $contents;
    }
}