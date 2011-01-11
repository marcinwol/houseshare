<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhotoUrl
 *
 * @author marcin
 */
class My_View_Helper_PhotoUrl extends Zend_View_Helper_Abstract {

    /**
     *
     *
     * @var  Zend_View_Interface
     */
    public $view;

    /**
     * Make an url to photo or its thumbnail
     *
     * @param My_Houseshare_Photo $photo Instance of My_Houseshare_Photo or string with relative photo path
     * @param boolean $is_thumb if true than url to thumb will be created
     * @return string url to the photo
     */
    public function photoUrl(My_Houseshare_Photo $photo, $is_thumb = false) {

        $baseUrl = $this->view->baseUrl();
        $photoBaseDirName = PHOTO_DIR_NAME;

        if (true === $is_thumb) {
            $photoBaseDirName .= '/' . THUMBS_DIR_NAME;
            // eg. $photoBaseDirName = images/thumbs
        }
       
       $photoPath = $photoBaseDirName . '/' . $photo->getFullPath();     

        return $baseUrl . '/' .$photoPath;
    }


    public function setView(Zend_View_Interface $view) {
        $this->view = $view;
    }

}
    ?>
