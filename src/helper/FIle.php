<?php

namespace Edk24\DockerPhpEnvironment\helper;

class File
{

    /**
     * 目录复制
     *
     * @param string $src
     * @param string $dst
     */
    public static function dirCopy(string $src, string $dst)
    {  

        $dir = opendir($src);
        @mkdir($dst);
        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($src . '/' . $file)) {
                    self::dirCopy($src . '/' . $file, $dst . '/' . $file);
                } else {
                    copy($src . '/' . $file, $dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}