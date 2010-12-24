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
    //put your code here

    public function testGetAllPreferences() {
        $modelState = new My_Model_DbTable_Preference();
        $arrayStates = $modelState->getPreferences()->toArray();
        $this->assertEquals(count($arrayStates),5);
    }

}
?>
