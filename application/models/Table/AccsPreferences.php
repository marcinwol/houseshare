<?php

/**
 *  Model for intersection table
 *  for MANY-to-MANY relationship between ACCOMMODATION and FEATURE
 *
 * @author marcin
 */
class My_Model_Table_AccsPreferences extends Zend_Db_Table_Abstract {

    protected $_name = "ACCOMODATION_has_PREFERENCE";
    protected $_rowClass = 'My_Model_Table_Row_AccsPreferences';
    protected $_rowsetClass = 'My_Model_Table_Rowset_AccsPreferences';
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


    /**
     * Delete a Account Preference
     * s
     * @param array $id compund id (acc_id,pref_id)
     * @return int Number of rows deleted
     */
    public function deleteAccPreference(array $id) {
        $row = $this->find($id['acc_id'], $id['pref_id'])->current();

         if (is_null($row)) {
            return 0;
        }

        return $row->delete();
    }

    /**
     * Insert/Updated intersecting table's data.
     *
     * @param array $data data
     * @param array $id   compund id (acc_id,pref_id)
     * @return array composite id of the new or updated row.
     */
    public function setAccPreference(array $data, array $id) {

        $row = $this->find($id['acc_id'],$id['pref_id'])->current();

        if (is_null($row)) {
            $row = $this->createRow();
        }

        $row->acc_id  = $id['acc_id'];
        $row->pref_id = $id['pref_id'];
        $row->value   = $data['value'];

        return $row->save();
    }

    

}

?>
