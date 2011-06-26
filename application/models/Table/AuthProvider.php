<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AuthProvider
 *
 * @author marcin
 */
class My_Model_Table_AuthProvider extends Zend_Db_Table_Abstract {

    protected $_name = "AUTH_PROVIDER";
    protected $_rowClass = 'My_Model_Table_Row_AuthProvider';
    protected $_referenceMap = array(
        'User' => array(
            'columns' => array('user_id'),
            'refTableClass' => 'My_Model_Table_User',
            'refColumns' => array('user_id'),
        )
    );
    /**
     * 
     * Associate array representing url openid identifiers and 
     * the names of thier providers
     *
     * @return array 
     */
    static public $_identifiers = array(
        'https://www.google.com/accounts/o8/id' => 'google',
        'http://me.yahoo.com/' => 'yahoo',
        'http://marcinwol.myopenid.com/' => 'myopenid',
        'https://www.facebook.com' => 'facebook',
        'https://www.twitter.com' => 'twitter'
    );

    /**
     * 
     * Associate array representing url openid identifiers and 
     * the names of thier providers
     *
     * @return array 
     */
    static public function getIdentifies() {
        return self::$_identifiers;
    }

    /**
     * 
     * Get auth provider name based on url openid identifiers 
     *
     * @return string Auth Provider name
     */
    static public function getProvider($identifier) {
        
        if (isset(self::$_identifiers[$identifier])) {
            return self::$_identifiers[$identifier];
        }
        
        return 'unknown';                
    }

    /**
     * Find provider by key
     *
     * @param string $value key value
     * @return Zend_Db_Table_Row
     */
    public function findByKey($value) {

        $value = trim($value);
        $select = $this->select()->where("AUTH_PROVIDER.key = ?", $value);
        return $this->fetchRow($select);
    }

    /**
     * Find provider by key
     *
     * @param string $key key value
     * @return Zend_Db_Table_Row
     */
    static public function fetchUsingKey($key) {
        $obj = new self();
        return $obj->findByKey($key);
    }

}

?>
