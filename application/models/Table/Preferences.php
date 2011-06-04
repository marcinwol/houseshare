<?php

/**
 * Model for PREFERENCES table
 *
 *
 *
 * @author marcin
 */
class My_Model_Table_Preferences extends Zend_Db_Table_Abstract {

    protected $_name = "PREFERENCES";
    protected $_rowClass = 'My_Model_Table_Row_Preferences';
    protected $_dependentTables = array('My_Model_Table_Accommodation');

 /**
     * user friendly names for the properties and their values. 
     * Used e.g. in a accommodation/show
     */
    static public $labels = array(
        'smokers' => array(
            'label' => 'Smokers accepted',
            'value' => array(
                '0' => 'No',
                '1' => 'Yes',
                '2' => 'No opinion'
            ),
            'default' => '2'
        ),
        'couples' => array(
            'label' => 'Couples accepted',
            'value' => array(
                '0' => 'No',
                '1' => 'Yes',
                '2' => 'No opinion'
            ),
            'default' => '2'
        ),
        'kids' => array(
            'label' => 'Kids accepted',
            'value' => array(
                '0' => 'No',
                '1' => 'Yes',
                '2' => 'No opinion'
            ),
            'default' => '2'
        ),
        'pets' => array(
            'label' => 'Pets accepted',
            'value' => array(
                '0' => 'No',
                '1' => 'Yes',
                '2' => 'No opinion'
            ),
            'default' => '2'
        ),
        'gender' => array(
            'label' => 'Gender',
            'value' => array(
                '0' => 'Male',
                '1' => 'Female',
                '3' => 'Not important'
            ),
            'default' => '3'
        ),
        'min_tenancy' => array(
            'label' => 'Minimum tenancy [month]',
            'value' => array(
                '0' => 'No opinion',
                '1' => '1',
                '2' => '2',
                '3' => '3',
                '4' => '6',
                '5' => '9',
                '6' => '12'                
            ),
            'default' => '0'
        ),
        'description' => array(
            'label' => 'Other',
        )
    );
    
    public function getLabels() {
        return self::$labels;
    }
   

}

?>
