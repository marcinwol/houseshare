<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccsPreferences
 *
 * @author marcin
 */
class My_Model_Table_Rowset_AccsPreferences extends Zend_Db_Table_Rowset_Abstract {

    /**
     * Returns all data as an array along with preference name
     *
     * @return array
     */
    public function asArray() {
        $data = array();
        foreach ($this as $i => $row) {
            $prefName = $row->getName();

            $data[] = array_merge($row->toArray(),array('name'=>$prefName));
        }
        return $data;
    }

    public function toArray() {
        return $this->asArray();
    }
    
    public function getByName($name) {
        foreach ($this as $row) {
            if ($name === $row->getName() || $name ===  str_replace (" ", "", $row->getName())) {
                return $row;
            }
        }
        return null;
    }
    
    /**
     * Delete a rowset
     * 
     * @return int number of rows deleted 
     */
    public function delete() {
        
        $i = 0;        
        foreach ($this as $row) {
            $i += $row->delete();
        }        
        return $i;
    }

}

?>
