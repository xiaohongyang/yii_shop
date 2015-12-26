<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2015/8/4
 * Time: 16:12
 */

namespace app\modules\adminshop\models;


class Language {


    public function get_lang_list($path=null)
    {

        if (is_null($path)) {

            $path = EC_PATH.'/languages';
        }

        $dir = opendir($path);
        $lang_list = array();
        while (@$file = readdir($dir))
        {
            if ($file != '.' && $file != '..' &&  $file != '.svn' && $file != '_svn' && is_dir($path.'/'.$file))
            {
                $lang_list[] = $file;
            }
        }
        @closedir($dir);

        return $lang_list;
    }

}