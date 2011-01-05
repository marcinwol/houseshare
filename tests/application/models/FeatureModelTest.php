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

    protected $_modelName = 'My_Model_Table_Feature';


    public function testGetAll() {
        $rowset = $this->_model->fetchAll();
        $this->assertEquals(count($rowset), 7);
    }

   /**
    *
    * @dataProvider getAllByTypeProvider
    */
   public function testGetAllByType($type_id, $expectedCount) {
    $rowset = My_Model_Table_Feature::getAllByType($type_id);
    $this->assertEquals($expectedCount, count($rowset));
   }

   public function getAllByTypeProvider() {
       return array(
           array(null, 5),
           array(2, 2),
       );
   }
}

?>
