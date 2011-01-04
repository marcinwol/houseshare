<?php


/**
 *  Model for intersection table
 *  for MANY-to-MANY relationship between ACCOMMODATION and FEATURE
 *
 * @author marcin
 */
class My_Model_Table_AccsFeatures extends Zend_Db_Table_Abstract {

    protected $_name = "ACCOMODATION_has_PREFERENCE";
    protected $_rowClass = 'My_Model_Table_Row_AccsPreferences';
    protected $_referenceMap = array(
        'Accommodation' => array(
            'columns' => array('acc_id'),
            'refTableClass' => 'My_Model_Table_Accommodation',
            'refColumns' => array('acc_id')
        ),
        'Preference' => array(
            'columns' => array('pref_id'),
            'refTableClass' => 'My_Model_Table_Preference',
            'refColumns' => array('pref_id')
        )
    );

}

?>
