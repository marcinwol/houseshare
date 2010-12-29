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
        $this->assertEquals(count($arrayStates), 3);
    }

    public function testGetAllStatesByPartialName() {
        $modelState = new My_Model_DbTable_State();
        $arrayStates = $modelState->findStatesBasedOnName('opo');
        $this->assertEquals(
                array(
                    $arrayStates[0]->name,
                    $arrayStates[1]->name
                ),
                array(
                    'Malopolska',
                    'Wielkopolska'
        ));
    }

}

?>
