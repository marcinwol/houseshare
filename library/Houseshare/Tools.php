<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * My set of various methods that may be handy.
 *
 * @author marcin
 */
class My_Houseshare_Tools {

    /**
     * Add DIRECTORY_SEPARATOR to the end of string if not there.
     * 
     * @param string $str input string
     * @return string  
     */
    static function addDirSeperator($str) {

        if ($str[strlen($str) - 1] !== DIRECTORY_SEPARATOR) {
            $str .= DIRECTORY_SEPARATOR;
        }

        return $str;
    }

    /**
     * Get values of econd level (SL) arrays of 2D array.
     *
     * @param array $data
     * @param string $key key in SL arrays.
     * @return array values in SL array with $key
     */
    static function getSLValsInArray(array $data, $key) {
        $vals = array();

        foreach ($data as $k => $d) {
            $vals [] = $d[$key];
        }

        return $vals;
    }

    /**
     * Return dir content as array
     * 
     * @param string $dirPath file path
     * @return array files/dirs in the $dirPath
     */
    static function getDirContent($dirPath) {
        $content = array();
        if ($handle = opendir($dirPath)) {
            while (false !== ($file = readdir($handle))) {
                if ($file != "." && $file != "..") {
                    $content [] = $file;
                }
            }
            closedir($handle);
        }

        return $content;
    }

    static function getIpAddress() {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    if (filter_var($ip, FILTER_VALIDATE_IP) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

}

?>
