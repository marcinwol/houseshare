<?php

/**
 *  Factory class to create various Houseshare objects
 *
 * @author marcin
 */
class My_Houseshare_Factory {

    /**
     * Get Houseshare_User or My_Houseshare_Roomate objects depending
     * on user type.
     *
     * @param int|null $id user id
     * @param string Type of an empty object to be created
     * @return My_Houseshare_User|null
     */
    static public function user($id = null, $type = '') {

        if (null === $id) {
            return self::_makeUserObj(null, $type);
        }

        $userModel = new My_Model_Table_User();
        $userRow = $userModel->find($id)->current();

        if (null === $userRow) {
            return null;
        }

         return self::_makeUserObj(null, $userRow->type);        
    }

     /**
     * Synonim to My_Houseshare_Factory::user($id, 'ROOMATE')
     *
     *
     * @see My_Houseshare_Factory::user()
     * @param int|null $id null idif $id not found
     * @return My_Houseshare_Roomate|null null if not found
     */
    static public function roomate($id = null) {
        return self::user($id, 'ROOMATE');
    }

    /**
     * Synonim to My_Houseshare_Factory::user($id, 'LOOkER')
     *
     * @todo  Make My_Houseshare_Looker
     * @see My_Houseshare_Factory::user()
     * @param int|null $id null idif $id not found
     * @return My_Houseshare_Looker|null null if not found
     */
    static public function looker($id = null) {
        throw new Exception('My_Houseshare_Looker not implemented');
        return self::user($id, 'LOOKER');
    }


    /**
     * Get Houseshare_Accommodation or My_Houseshare_Shared objects depending
     * on accommodation type.
     *
     * @param int|null $id null idif $id not found
     * @param string Type of an empty object to be created
     * @return My_Houseshare_Accommodation|null null if not found
     */
    static public function accommodation($id = null, $type = '') {

        if (null === $id) {
            return self::_makeAccObj(null, $type);
        }

        $accModel = new My_Model_Table_Accommodation();

        /* @var $accRow My_Model_Table_Row_Accommodation */
        $accRow = $accModel->find($id)->current();

        if (null === $accRow) {
            return null;
        }

        return self::_makeAccObj($id, strtoupper($accRow->getType()->name));
    }

    /**
     * Synonim to My_Houseshare_Factory::room($id, 'ROOM')
     *
     * At the momenet there are no speciall classes for Bed and Room. Both
     * are threated as Shared accommodation.
     *
     * @see My_Houseshare_Factory::accommodation()
     * @param int|null $id null idif $id not found
     * @return My_Houseshare_Shared|null null if not found
     */
    static public function shared($id = null) {
        return self::accommodation($id, 'BED');
    }

    /**
     * Shortcut My_Houseshare_Factory::accommodation($id, 'BED')
     *
     * At the momenet there are no speciall classes for Bed and Room. Both
     * are threated as Shared accommodation.
     * 
     * @see My_Houseshare_Factory::accommodation()
     * @param int|null $id null idif $id not found
     * @return My_Houseshare_Shared|null null if not found
     */
    static public function bed($id = null) {
        return self::accommodation($id, 'BED');
    }

    /**
     * Shortcut My_Houseshare_Factory::accommodation($id, 'ROOM')
     *
     * At the momenet there are no speciall classes for Bed and Room. Both
     * are threated as Shared accommodation.
     *
     * @see My_Houseshare_Factory::accommodation()
     * @param int|null $id null  if $id not found
     * @return My_Houseshare_Shared|null null if not found
     */
    static public function room($id = null) {
        return self::accommodation($id, 'ROOM');
    }

    static protected function _makeAccObj($id, $type) {
        switch ($type) {
            case 'ROOM':
                return new My_Houseshare_Shared($id);
                break;
            case 'BED':
                return new My_Houseshare_Shared($id);
                break;
            default:
                return new My_Houseshare_Accommodation($id);
        }
    }

    static protected function _makeUserObj($id, $type) {
        switch ($type) {
            case 'ROOMATE':
                return new My_Houseshare_Roomate($id);
                break;
            case 'BED':
                // @todo No My_Houseshare_Looker class yet.
                return new My_Houseshare_Looker($id);
                break;
            default:
                return new My_Houseshare_User($id);
        }
    }

    /**
     * Get My_Houseshare_Photo object.
     *
     * @param int|null $id of a user. New object if null
     * @return My_Houseshare_Photo|null if $id not found
     */
    static public function photo($id = null) {
        try {
            return new My_Houseshare_Photo($id);
        } catch (Zend_Db_Exception $e) {
            return null;
        }
    }

}

?>
