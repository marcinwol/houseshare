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
        $fulPaths = array();

        foreach ($this as $photo) {
            $fulPaths[] = array(
                'photo_id' => $photo->photo_id,
                'path' => $photo->getFullPath()
            );
        }

        return $fulPaths;
    }

}

?>
