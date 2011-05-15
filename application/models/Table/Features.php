<?php

/**
 * Model for FEATURES table
 * 
 *
 *
 * @author marcin
 */
class My_Model_Table_Features extends Zend_Db_Table_Abstract {

    protected $_name = "FEATURES";
    protected $_rowClass = 'My_Model_Table_Row_Features';
    protected $_dependentTables = array('My_Model_Table_Accommodation');
    
    /**
     * user friendly names for the properties and their values. 
     * Used e.g. in a accommodation/show
     */
    static public $labels = array(
        'internet' => array(
            'label' => 'Internet',
            'value' => array(
                '0' => 'No',
                '1' => 'Yes',
                '2' => 'Dial-up',
                '3' => 'Broadband'                
            ),
            'default' => '0'
        ),
        'tv' => array(
            'label' => 'Television',
            'value' => array(
                '0' => 'No',
                '1' => 'Yes',
                '2' => 'Cable',
                '3' => 'Satelite'
            ),
            'default' => '0'
        ),
        'air_con' => array(
            'label' => 'Air conditioning',
            'value' => array(
                '0' => 'No',
                '1' => 'Yes'
            ),
            'default' => '0'
        ),
        'parking' => array(
            'label' => 'Parking',
            'value' => array(
                '0' => 'No',
                '1' => 'Yes',
                '3' => 'Garage'
            ),
            'default' => '0'
        ),
        'furniture' => array(
            'label' => 'Furniture',
            'value' => array(
                '0' => 'Unfurnished',
                '1' => 'Partially furnished',
                '3' => 'Fully furnished'
            ),
            'default' => '0'
        ),
        'description' => array(
            'label' => 'Other',
        )
    );




}

?>
