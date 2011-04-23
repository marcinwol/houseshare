<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Appartment
 *
 * @author marcin
 */
class My_Model_Table_Appartment extends Zend_Db_Table_Abstract {

    protected $_name = "APPARTMENT";
    protected $_rowClass = 'My_Model_Table_Row_Appartment';


    protected $_referenceMap = array(
        'Accommodation' => array(
            'columns' => array('acc_id'),
            'refTableClass' => 'My_Model_Table_Accommodation',
            'refColumns' => array('acc_id'),
        ),
        'NonSharedDetails' => array(
            'columns' => array('details_id'),
            'refTableClass' => 'My_Model_Table_NonSharedDetails',
            'refColumns' => array('details_id'),
        )
    );


    /**
     * Update/insert appartment.
     *
     * @param array $data data of the appartment
     * @param <type> $id shared id
     * @return int  ID of the updated/new appartment row
     */
    public function setAppartment(array $data, $id) {

        $row = $this->find($id)->current();

        if (is_null($row)) {
            $row = $this->createRow();
        }

        $row->acc_id = $id;
        $row->details_id = $data['details_id'];

        // if there are some more properties for appartment you can set them here.

        return $row->save();
    }


}

?>
