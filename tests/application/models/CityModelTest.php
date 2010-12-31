<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CityModelTest
 *
 * @author marcin
 */
class CityModelTest extends ModelTestCase {

    //put your code here

    public function testGetAllCities() {
        $modelState = new My_Model_Table_City();
        $arrayStates = $modelState->getCities()->toArray();
        $this->assertEquals(count($arrayStates), 3);
    }

    public function testGetAllCitiesByPartialName() {
        $modelState = new My_Model_Table_City();
        $arrayStates = $modelState->findCitiesBasedOnName('ta');
        $this->assertEquals(
                array(
                    $arrayStates[0]->name,                  
                ),
                array(
                    'Nowy Targ'
        ));
    }

}

?>
