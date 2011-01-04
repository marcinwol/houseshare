<?php

/**
 *  Model for intersection table
 *  for MANY-to-MANY relationship between ACCOMMODATION and FEATURE
 *
 * @author marcin
 */
class My_Model_Table_AccsFeatures extends Zend_Db_Table_Abstract {

    protected $_name = "ACCOMODATION_has_FEATURE";
     protected $_rowClass = 'My_Model_Table_Row_AccsFeatures';
      protected $_rowsetClass = 'My_Model_Table_Rowset_AccsFeatures';

    protected $_referenceMap    = array(
        'Accommodation' => array(
            'columns'           => array('acc_id'),
            'refTableClass'     => 'My_Model_Table_Accommodation',
            'refColumns'        => array('acc_id')
        ),
        'Feature' => array(
            'columns'           => array('feat_id'),
            'refTableClass'     => 'My_Model_Table_Feature',
            'refColumns'        => array('feat_id')
        )
    );
    
}
?>
