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
class My_Model_Table_NonSharedDetails extends Zend_Db_Table_Abstract {

    protected $_name = "NONSHARE_ACC_DETAILS";
    protected $_rowClass = 'My_Model_Table_Row_NonSharedDetails';
    protected $_dependentTables = array('My_Model_Table_Appartment');


    /**
     * Update/insert details row.
     *
     * @param array $data data of the details
     * @param int $id details id
     * @return int  ID of the updated/new details
     */
    public function setDetails(array $data, $id = null) {

        $row = $this->find($id)->current();

        if (is_null($row)) {
            $row = $this->createRow();
        }
       
        $row->bedrooms = $data['bedrooms'];
        $row->bathrooms = $data['bathrooms'];
        $row->parking_spots = $data['parking_spots'];
        $row->description = $data['description'];

        return $row->save();
    }


}

?>
