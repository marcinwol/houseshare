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


     /**
     * Delete a Account Feature
     * s
     * @param array $id compund id (acc_id,pref_id)
     * @return int Number of rows deleted
     */
    public function deleteAccFeature(array $id) {
        $row = $this->find($id['acc_id'], $id['feat_id'])->current();

        if (is_null($row)) {
            return 0;
        }

        return $row->delete();
    }
    
    /**
     * Insert/Updated intersecting table's data.
     *
     * @param array $data data
     * @param array $id   compund id (acc_id,feat_id)
     * @return array composite id of the new or updated row.
     */
    public function setAccFeature(array $data, array $id) {

        $row = $this->find($id['acc_id'],$id['feat_id'])->current();

        if (is_null($row)) {
            $row = $this->createRow();
        }

        $row->acc_id  = $id['acc_id'];
        $row->feat_id = $id['feat_id'];
        $row->value   = $data['value'];

        return $row->save();
    }

    
}
?>
