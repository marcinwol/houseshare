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

     /**
     * STATE table model
     *
     * @var My_Model_Table_STATE
     */
    private $_model;

    public function setUp() {
        parent::setUp();
        $this->_model = new My_Model_Table_State();
    }

    public function tearDown() {
        $this->_model = null;
        parent::tearDown();
    }


    public function testGetAllStates() {        
        $arrayStates = $this->_model->getStates()->toArray();
        $this->assertEquals(count($arrayStates), 3);
    }

    public function testGetAllStatesByPartialName() {       
        $arrayStates = $this->_model->findStatesBasedOnName('opo');
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


  /**
     * @dataProvider insertStateProvider
     */
    public function testInsertState($value, $expectedId) {
        $id = $this->_model->insertState(array('state_name' => $value));
        $this->assertEquals($id, $expectedId);
    }

    public function insertStateProvider() {
        return array(
            array(' Malopolska', 1),
            array(' Malopolska   ', 1),
            array(' Wielkopolska  ', 2),
            array(' DOLNOSLASKIE ', 3),
            array(' DONLONSLASKIE ', 4)
        );
    }

    /**
     * @dataProvider stateValuesProvider1
     */
    public function testFindByValueCorrect($value, $expectedResult) {
        $state = $this->_model->findByValue($value);
        $this->assertEquals($state->current()->name, $expectedResult);
    }

    public function stateValuesProvider1() {
        return array(
            array(' Malopolska', 'Malopolska'),
            array(' Malopolska   ', 'Malopolska'),
            array(' DOLNOSLASKIE  ', 'Dolnoslaskie'),
            array(' Wielkopolska   ', 'Wielkopolska')
        );
    }

    /**
     * @dataProvider stateValuesProvider2
     */
    public function testFindByValueInCorrect($value) {
        $state = $this->_model->findByValue($value);
        $this->assertEquals(count($state), 0);
    }

    public function stateValuesProvider2() {
        return array(
            array(' MalopolskaA'),
            array(' DONLONSLASKIEE  '),
            array(' Malopolskie   ')
        );
    }



}

?>
