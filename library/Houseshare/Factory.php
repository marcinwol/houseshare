<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

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
     * @param int $id user id
     * @return My_Houseshare_User | null
     */
    static public function user($id = null) {

        if (null === $id) {
            return new My_Houseshare_User();
        }

        $userModel = new My_Model_Table_User();
        $userRow = $userModel->find($id)->current();

        if (null === $userRow) {
            return null;
        }

        switch ($userRow->type) {
            case 'USER':
                return new My_Houseshare_User($id);
                break;
            case 'ROOMATE':
                return new My_Houseshare_Roomate($id);
        }
    }

    /**
     * Get Houseshare_Accommodation or My_Houseshare_Shared objects depending
     * on accommodation type.
     *
     * @param int | null $id null idif $id not found
     * @param string Type of an empty object to be created
     * @return My_Houseshare_Accommodation | null null if not found
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
     * Shortcut self::accommodation($id, 'BED')
     *
     * At the momenet there are no speciall classes for Bed and Room. Both
     * are threated as Shared accommodation.
     * 
     * @see My_Houseshare_Factory::accommodation
     * @param int | null $id null idif $id not found
     * @param string Type of an empty object to be created
     * @return My_Houseshare_Shared | null null if not found
     */
    static public function bed($id = null) {
        return self::accommodation($id, 'BED');
    }

    /**
     * Shortcut self::accommodation($id, 'ROOM')
     *
     * At the momenet there are no speciall classes for Bed and Room. Both
     * are threated as Shared accommodation.
     *
     * @see My_Houseshare_Factory::accommodation
     * @param int | null $id null idif $id not found
     * @param string Type of an empty object to be created
     * @return My_Houseshare_Shared | null null if not found
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

    /**
     * Get My_Houseshare_Photo object.
     *
     * @param int | null $id of a user. New object if null
     * @return My_Houseshare_Photo | null if $id not found
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
