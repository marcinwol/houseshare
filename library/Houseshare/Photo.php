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
class My_Houseshare_Photo extends My_Houseshare_Abstract_PropertyAccessor {

    protected $_modelName = 'View_Photo';


    /**
     * Sets accommodation id. This must be done using this method
     * since directly setting id properties is not allowed.
     *
     * @param int $id  accommodation id
     */
    public function setAccId($id) {
        $this->_properties['acc_id'] = (string) $id;
    }

    /**
     * Insert new photo in the database along with its path.
     * Theire is not update since updating a photo (i.e. changing the photo)
     * is just substitution of files on the hard disk rather than records
     * in database.
     *
     *
     * @return int Primary key of inserted/updated  row
     */
    public function save() {

        // insert path
        if (in_array('path', $this->_changedProperties)) {
            $pathModel = new My_Model_Table_Path();

            $path_id = $pathModel->insertPath(
                            array('path_value' => $this->path)
            );
        } else {
            $path_id = $this->_properties['path_id'];
        }


        // insert photo
        $photo_id = $this->getModel()->insertPhoto(
                        array(
                            'filename' => $this->filename,
                            'path_id' => $path_id,
                            'acc_id' => $this->acc_id
                        )
        );

        $this->_populateProperties($photo_id);

        return $photo_id;
    }

}

?>
