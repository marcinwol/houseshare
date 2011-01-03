<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of path
 *
 * @author marcin
 */
class My_Model_Table_Path extends Zend_Db_Table_Abstract {

    protected $_name = "PATH";
    protected $_rowClass = 'My_Model_Table_Row_Path';
    protected $_dependentTables = array('My_Model_Table_Photos');



    /**
     * Get path by its id.
     *
     * @param int $id path id
     * @return Zend_Db_Table_Row_Path
     */
    public function getPath($id) {
        return $this->find($id)->current();
    }

     /**
     * Find Path by name
     *
     * @param string $value path value
     * @return Zend_Db_Table_Row_Path
     */
    public function findByValue($value) {

        $value = trim($value);

        return $this->fetchRow("value = '$value'");
    }


    /**
     * Insert path if does not exisit.
     *
     * @param array $data path data
     * @return int primary key value of path
     */
    public function insertPath(array $data) {

        $row = $this->findByValue($data['path_value']);

        if (is_null($row)) {
            //if 0 than such path does not exist so create it.
            return $this->insert(array('value' => $data['path_value']));
        } else {
            // such path exists thus return its id
            return $row->path_id;
        }
    }

}
?>
