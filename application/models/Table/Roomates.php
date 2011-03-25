<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Roomate
 *
 * @author marcin
 */
class My_Model_Table_Roomates extends Zend_Db_Table_Abstract {

    protected $_name = "ROOMATES";
    protected $_rowClass = 'My_Model_Table_Row_Roomates';
    protected $_dependentTables = array('My_Model_Table_Shared');


    /**
     * Update/insert roomates row.
     *
     * @param array $data data of the roomates
     * @param int $id roomates id
     * @return int  ID of the updated/new roomates
     */
    public function setRoomates(array $data, $id = null) {

        $row = $this->find($id)->current();

        if (is_null($row)) {
            $row = $this->createRow();
        }
       
        $row->no_roomates = $data['no_roomates'];
        $row->min_age = $data['min_age'];
        $row->max_age = $data['max_age'];
        $row->gender = $data['gender'];
        $row->description = $data['description'];

        return $row->save();
    }


}

?>
