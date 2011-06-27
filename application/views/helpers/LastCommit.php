<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LastCommit
 *
 * @author marcin
 */
class My_View_Helper_LastCommit extends Zend_View_Helper_Abstract {


    const FILE_NAME = 'last_commit.txt';
    
    
    /**
     * Return date and time of the last commit
     * 
     * @return string 
     */
    public function lastCommit() {
        
        $fpath = APPLICATION_PATH . '/../' . self::FILE_NAME;        
        
        if (!file_exists($fpath)) {
            return '';
        }
        
        $fileContents = file_get_contents($fpath);
        
        $timestamp = strtotime($fileContents);
        
        if (false == $timestamp) {
            return '';
        }
        
        $lastCommit = date("d/m/Y H:i",  $timestamp);
                     
        return $lastCommit;
    }

}
?>
