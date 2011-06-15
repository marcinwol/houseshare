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
class My_Model_Table_Rowset_Photo extends Zend_Db_Table_Rowset {

    /**
     * Get fullPaths for this Photo rowset.
     *
     * @return array Array of photo full paths
     */
    public function getFullPaths() {
        $fullPaths = array();

        foreach ($this as $photo) {
            $fullPaths[] = array(
                'photo_id' => $photo->photo_id,
                'path' => $photo->getFullPath(),
                'filename' => $photo->filename,
                'acc_id' => $photo->acc_id,
                'path_id' => $photo->path_id
            );
        }

        return $fullPaths;
    }


    public function toArray() {
        return $this->getFullPaths();
    }
    
    /**
     * Return only IDs of photos.
     * 
     * @return array of photos IDs 
     */
    public function getPhotosIDs() {
        $ids = array();
        
        foreach ($this as $row) {
            $ids []= $row->photo_id;
        }
        
        return $ids;
    }

}

?>
