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
        ),
        'Features' => array(
            'columns' => array('features_id'),
            'refTableClass' => 'My_Model_Table_Features',
            'refColumns' => array('features_id'),
        ),
        'Preferences' => array(
            'columns' => array('preferences_id'),
            'refTableClass' => 'My_Model_Table_Preferences',
            'refColumns' => array('preferences_id'),
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
            $row->created = new Zend_Db_Expr('NOW()');
        }

        $row->title = $data['title'];
        $row->description = $data['description'];
        $row->addr_id = $data['addr_id'];
        $row->user_id = $data['user_id'];
        $row->date_avaliable = $data['date_avaliable'];
        $row->price = $data['price'];
        $row->price_info = $data['price_info'];
        $row->bond = $data['bond'];
        $row->street_address_public = $data['street_address_public'];
        $row->short_term_ok = $data['short_term_ok'];
        $row->preferences_id = $data['preferences_id'];
        $row->features_id = $data['features_id'];
        $row->type_id = $data['type_id'];
        $row->updated = new Zend_Db_Expr('NOW()');
        if (isset($data['is_enabled'])) {
            $row->is_enabled = $data['is_enabled'];
        }

        return $row->save();
    }

    /**
     * Return $no of newest accommodations
     * @param int $no Sets the limit of select 
     * @return Zend_Paginator Zend_Paginator
     */
    public function getLastAccommodations($page = 1, $no = 5) {
        $select = $this->select();

        $select->order('created DESC')
                ->where('ACCOMMODATION.is_enabled = ?', 1);

        return $this->getAccPaginator($select, $page, $no);
    }

    /**
     * Get accommodation list paginator.
     *  
     * @param Zend_Db_Select $query
     * @param int $page
     * @param int $no
     * @return Zend_Paginator 
     */
    public function getAccPaginator(Zend_Db_Select $query, $page = 1, $no = 5) {
        $paginator = new Zend_Paginator(
                        new Zend_Paginator_Adapter_DbTableSelect($query)
        );
        $paginator->setItemCountPerPage($no);
        $paginator->setCurrentPageNumber($page);
        return $paginator;
    }

    /**
     *
     * @return array  
     */
    static public function getDistinctCities() {

        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()->from('ACCOMMODATION', '')
                ->joinInner('ADDRESS', 'ACCOMMODATION.addr_id = ADDRESS.addr_id', '')
                ->joinInner('CITY', 'ADDRESS.city_id = CITY.city_id', array('CITY.city_id', 'CITY.name'))
                ->where('ACCOMMODATION.is_enabled = ?', 1)
                ->order('CITY.name ASC')
                ->distinct();

        return $db->fetchAll($select);
    }

    /**
     * Get top cities
     * 
     * @return array  
     */
    static public function getTopCities($limit = 5) {

        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()->from('ACCOMMODATION', 'COUNT(acc_id) as count')
                ->joinInner('ADDRESS', 'ACCOMMODATION.addr_id = ADDRESS.addr_id', '')
                ->joinInner('CITY', 'ADDRESS.city_id = CITY.city_id', array('CITY.city_id', 'CITY.name'))
                ->order('count DESC')
                ->where('ACCOMMODATION.is_enabled = ?', 1)
                ->limit($limit)
                ->group('CITY.name');


        return $db->fetchAll($select);
    }

    /**
     * Get recently viewd advertisments
     * 
     * @return array  
     */
    static public function getRecentlyViewed($limit = 5) {

        $db = Zend_Db_Table::getDefaultAdapter();

        $select = $db->select()->from('ACCOMMODATION', array('ACCOMMODATION.acc_id', 'ACCOMMODATION.title'))
                ->joinInner(new Zend_Db_Expr(
                                '(SELECT acc_id as acco_id, MAX(created) as last_time FROM VIEWS_COUNTER 
                         GROUP BY acc_id)'
                        ), 'ACCOMMODATION.acc_id = acco_id', 'last_time')
                ->joinInner('ADDRESS', 'ACCOMMODATION.addr_id = ADDRESS.addr_id', '')
                ->joinInner('CITY', 'ADDRESS.city_id = CITY.city_id', 'CITY.name as city')
                ->where('ACCOMMODATION.is_enabled = ?', 1)
                ->order('last_time DESC')
                ->limit($limit);

        return $db->fetchAll($select);
    }

    /**
     * Create initial JOIN that will be used in application/list
     * to search and limit the list of avaliable accommodations 
     * for display
     * 
     * @param $conditions List of condition for the join, e.g. city_id
     * @return Zend_Db_Select  
     */
    public function getListofAccommodations(array $conditions = array()) {

        $select = $this->select(Zend_Db_Table::SELECT_WITH_FROM_PART)
                ->setIntegrityCheck(false)
                ->where('ACCOMMODATION.is_enabled = ?', 1);

        $select->joinInner(
                'ADDRESS', 'ACCOMMODATION.addr_id = ADDRESS.addr_id', array()
        );

        $select->joinInner(
                'PREFERENCES', 'ACCOMMODATION.preferences_id = PREFERENCES.preferences_id', array()
        );

        $select->joinInner(
                'FEATURES', 'ACCOMMODATION.features_id = FEATURES.features_id', array()
        );

        if (isset($conditions['city_id'])) {
            $select->where("ADDRESS.city_id = ?", $conditions['city_id']);
        }
        
        if (isset($conditions['internet'])) {
            $select->where("FEATURES.internet > 0");
        }
        
         if (isset($conditions['price'])) {
            $select->where("ACCOMMODATION.price < ?", $conditions['price']);
         }
         
         if (isset($conditions['type_id'])) {
            $select->where("ACCOMMODATION.type_id IN " . $conditions['type_id']);
         }        
         
         $select->order("ACCOMMODATION.created DESC");
        
         $select->distinct();
        
        return $select;
    }

}

?>
