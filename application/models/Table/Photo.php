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
class My_Model_Table_Photo extends Zend_Db_Table_Abstract {

    protected $_name = "PHOTO";
    protected $_rowClass = 'My_Model_Table_Row_Photo';
    protected $_referenceMap = array(
        'Accommodation' => array(
            'columns' => array('acc_id'),
            'refTableClass' => 'My_Model_Table_Accommodation',
            'refColumns' => array('acc_id'),
        ),
        'Path' => array(
            'columns' => array('path_id'),
            'refTableClass' => 'My_Model_Table_Path',
            'refColumns' => array('path_id'),
        )
    );

    /**
     * Get photo by its id.
     *
     * @param int $id photo id
     * @return My_Model_Table_Row_Photo
     */
    public function getPhoto($id) {
        return $this->find($id)->current();
    }

    /**
     * Find photo by its filename and path
     *
     * @param string $filename photo name
     * @param int $path_id Id of a path in which the photo is
     * @return My_Model_Table_Row_Photo
     */
    public function findByNameAndPath($filename, $path_id) {

        $filename = trim($filename);

        return $this->fetchRow("filename = '$filename' AND path_id = $path_id");
    }

    /**
     * Insert photo.
     *
     * @param array $data photo data
     * @return int primary key value of photo
     */
    public function insertPhoto(array $data) {

        return $this->insert(array(
            'filename' => $data['filename'],
            'path_id' => $data['path_id'],
            'acc_id' => $data['acc_id']
        ));
    }

    /**
     * Update photo.
     *
     * @param array $data photo data
     * @param int $id photo id 
     * @return int primary key of row updated
     */
    public function updatePhoto(array $data, $id) {
        $row = $this->getPhoto($id);

        if (is_null($row)) {
            //if null than such photo does throw exception.
            throw new Zend_Db_Exception('No photo with id = ' . $id);
        }

        $row->filename = $data['filename'];
        $row->path_id  = $data['path_id'];
        $row->acc_id   = $data['acc_id'];
        
        return $row->save();
    }

}

?>
