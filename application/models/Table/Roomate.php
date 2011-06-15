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
class My_Model_Table_Roomate extends Zend_Db_Table_Abstract {

    protected $_name = "ROOMATE";
    protected $_rowClass = 'My_Model_Table_Row_Roomate';
    protected $_referenceMap = array(
        'User' => array(
            'columns' => array('user_id'),
            'refTableClass' => 'My_Model_Table_User',
            'refColumns' => array('user_id'),
        )
    );


    /**
     * Update/insert roomate.
     *
     * @param array $data data of the roomate
     * @param <type> $id roomate id
     * @return int  ID of the updated/new roomate
     */
    public function setRoomate($data, $id) {

        $row = $this->find($id)->current();

        if (is_null($row)) {
            $row = $this->createRow();
        }

        $row->user_id = $id;
        $row->is_owner = $data['is_owner'];

        return $row->save();
    }


}

?>
