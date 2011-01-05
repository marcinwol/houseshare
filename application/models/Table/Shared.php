<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Shared
 *
 * @author marcin
 */
class My_Model_Table_Shared extends Zend_Db_Table_Abstract {

    protected $_name = "SHARED";
    protected $_rowClass = 'My_Model_Table_Row_Shared';

    protected $_dependentTables = array(
        'My_Model_Table_Roomates'
    );

    protected $_referenceMap = array(
        'Accommodation' => array(
            'columns' => array('acc_id'),
            'refTableClass' => 'My_Model_Table_Accommodation',
            'refColumns' => array('acc_id'),
        ),
        'Roomates' => array(
            'columns' => array('roomates_id'),
            'refTableClass' => 'My_Model_Table_Roomates',
            'refColumns' => array('roomates_id'),
        )
    );


    /**
     * Update/insert shared accommodation.
     *
     * @param array $data data of the shared
     * @param <type> $id shared id
     * @return int  ID of the updated/new shared
     */
    public function setShared(array $data, $id) {

        $row = $this->find($id)->current();

        if (is_null($row)) {
            $row = $this->createRow();
        }

        $row->acc_id = $id;
        $row->roomates_id = $data['roomates_id'];

        // if there are some more properties for shared you can set them here.

        return $row->save();
    }


}

?>
