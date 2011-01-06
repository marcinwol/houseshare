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
     * Get Houseshare_User object
     *
     * @param int $id user id
     * @return My_Houseshare_User | null
     */
    static public function user($id) {
        $userModel = new My_Model_Table_User();
        $userRow = $userModel->find($id)->current();
        
        if (null === $userRow) {
            return null;
        }

        $roomate = $userRow->getRoomate();
        if (null !== $roomate) {
            return new My_Houseshare_Roomate($id);
        }

        return new My_Houseshare_User($id);

    }

    /**
     * Get My_Houseshare_Photo object.
     *
     * @param int | null $id of a user. New object if null
     * @return My_Houseshare_User | null if $id not found
     */
    static public function photo($id = null) {
        try {
            return new My_Houseshare_User($id);
        } catch (Zend_Db_Exception $e) {
            return null;
        }
    }

}
?>
