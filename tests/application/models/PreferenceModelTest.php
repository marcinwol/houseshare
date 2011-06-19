<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PreferenceModelTest
 *
 * @author marcin
 */
class PreferenceModelTest extends ModelTestCase {


    protected $_modelName = 'My_Model_Table_Preferences';


    public function testGetAll1() {
        $rowset = $this->_model->fetchAll();
        $this->assertEquals(count($rowset),5);
    }
//
//    public function testGetAll2() {
//        $rowset = My_Model_Table_Preference::getAllPreferences();
//        $this->assertEquals(count($rowset),5);
//    }

}
?>
