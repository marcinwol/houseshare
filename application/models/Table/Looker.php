<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Looker
 *
 * @author marcin
 */
class My_Model_Table_Looker extends Zend_Db_Table_Abstract {

    protected $_name = "LOOKER";
    protected $_rowClass = 'My_Model_Table_Row_Looker';
    protected $_referenceMap = array(
        'User' => array(
            'columns' => array('user_id'),
            'refTableClass' => 'My_Model_Table_User',
            'refColumns' => array('user_id'),
        )
    );


    /**
     * Update/insert looker.
     *
     * @param array $data data of the looker
     * @param <type> $id looker id
     * @return int  ID of the updated/new looker
     */
    public function setLooker($data, $id) {

        $row = $this->find($id)->current();

        if (is_null($row)) {
            $row = $this->createRow();
        }

        $row->user_id = $id;

        // if there are some more properties for looker you can set them here.

        return $row->save();
    }


}

?>
