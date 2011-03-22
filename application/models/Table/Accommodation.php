<?php

/**
 * Description of Accommodation
 *
 * @author marcin
 */
class My_Model_Table_Accommodation extends Zend_Db_Table_Abstract {

    protected $_name = "ACCOMMODATION";
    protected $_rowClass = 'My_Model_Table_Row_Accommodation';
    protected $_rowsetClass = 'My_Model_Table_Rowset_Accommodation';
     
    protected $_dependentTables = array(
        'My_Model_Table_Photo',
        'My_Model_Table_Shared'
    );
    protected $_referenceMap = array(
        'Address' => array(
            'columns' => array('addr_id'),
            'refTableClass' => 'My_Model_Table_Address',
            'refColumns' => array('addr_id'),
        ),
        'User' => array(
            'columns' => array('user_id'),
            'refTableClass' => 'My_Model_Table_User',
            'refColumns' => array('user_id'),
        ),
         'Type' => array(
            'columns' => array('type_id'),
            'refTableClass' => 'My_Model_Table_Type',
            'refColumns' => array('type_id'),
        )
    );

    /**
     * Update/insert accommodation.
     *
     * @param array $data data of the accommodation
     * @param <type> $id accommodation id
     * @return int  ID of the updated/new accommodation
     */
    public function setAccommodation($data, $id = null) {

        $row = $this->find($id)->current();

        if (is_null($row)) {
            $row = $this->createRow();
        }

        $row->title = $data['title'];
        $row->description = $data['description'];
        $row->addr_id = $data['addr_id'];
        $row->user_id = $data['user_id'];
        $row->date_avaliable = $data['date_avaliable'];
        $row->price = $data['price'];
        $row->bond = $data['bond'];
        $row->street_address_public = $data['street_address_public'];
        $row->short_term_ok = $data['short_term_ok'];
        $row->type_id = $data['type_id'];

        return $row->save();
    }
    
    
    /**
     * Return $no of newest accommodations
     * @param int $no Sets the limit of select 
     * @return Zend_Db_Table_Rowset last added accommodations
     */
    public function getLastAccommodations($no = 10) {
        $select = $this->select();
        $select->order('created DESC')->limit($no);
        return $this->fetchAll($select);
    }
    
    /**
     *
     * @return array  
     */
    static public function getDistinctCities() {
        
        $db = Zend_Db_Table::getDefaultAdapter();
        $select = $db->select()->from('ACCOMMODATION','')
                ->joinInner('ADDRESS', 'ACCOMMODATION.addr_id = ADDRESS.addr_id', '')
                ->joinInner('CITY', 'ADDRESS.city_id = CITY.city_id', array('CITY.city_id','CITY.name'))
                ->order('CITY.name ASC')
                ->distinct();

        return $db->fetchAll($select);
        
    }

    
    
}

?>
