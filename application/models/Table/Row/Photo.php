<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Photo
 *
 * @author marcin
 */
class My_Model_Table_Row_Photo extends Zend_Db_Table_Row_Abstract {

    /**
     * Get Path row
     *
     * @return My_Model_Table_Row_Path
     */
    public function getPath() {
        return $this->findParentRow('My_Model_Table_Path');
    }

    /**
     * Get full path to the photo file.
     *
     * @return string Photo path
     */
    public function getFullPath() {
        return $this->getPath()->value . $this->filename;
    }

    /**
     * Get Accommodation that owns this photo.
     *
     * @return My_Model_Table_Row_Accommodation
     */
    public function getAccommodation() {
        return $this->findParentRow('My_Model_Table_Accommodation');
    }

}

?>
