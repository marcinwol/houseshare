<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of StateModelTest
 *
 * @author marcin
 */
class StateModelTest extends ModelTestCase {
    //put your code here

    public function testGetAllStates() {
        $modelState = new My_Model_DbTable_State();
        $arrayStates = $modelState->getStates()->toArray();
        $this->assertEquals(count($arrayStates),3);
    }

}
?>
