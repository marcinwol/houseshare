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
     * user friendly names for the properties and their values. 
     * Used e.g. in a accommodation/show
     */
    static public $labels = array(
        'bedrooms' => array(
            'label' => 'No. of bedrooms',            
        ),
        'bathrooms' => array(
            'label' => 'No. of bathrooms',
        ),
        'parking_spots' => array(
            'label' => 'No. of parking spots',
        ),
        'description' => array(
            'label' => 'Description',
        )
    );


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
        $row->furnished = (isset($data['furnished']) ? $data['furnished'] : new Zend_Db_Expr('NULL'));                
        $row->size = (isset($data['size']) ? $data['size'] : new Zend_Db_Expr('NULL'));
        $row->description = (isset($data['description']) ? $data['description'] : new Zend_Db_Expr('NULL'));      

        return $row->save();
    }


}

?>
