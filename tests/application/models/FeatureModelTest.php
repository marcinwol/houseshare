<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FeatureModelTest
 *
 * @author marcin
 */
class FeatureModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_Features';


    public function testGetAll() {
        $rowset = $this->_model->fetchAll();
        $this->assertEquals(count($rowset), 5);
    }
  
}

?>
