<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of LookerModelTest
 *
 * @author marcin
 */
class LookerModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_Looker';

 public function testGetUser() {
         $looker = $this->_model->find(2)->current();
         $userRow = $looker->getUser();
         $this->assertEquals('Michal',$userRow->first_name);
    }

}

?>
