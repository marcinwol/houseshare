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
class TypeModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_Type';

    public function testGetByName() {
        $typeNames = array('Bed', 'Room', 'Appartment');

        foreach ($typeNames as $typeName) {
            $row = My_Model_Table_Type::getByName($typeName);
            $this->assertEquals($typeName, $row->name);
        }
    }

    public function testFindByValue() {

        $row = $this->_model->findByValue('Room');
        $this->assertEquals(2, $row->type_id);
    }

    public function testInsertType() {

        // type exists so return its id
        $result_id = $this->_model->insertType(array('name' => 'Room'));
        $this->assertEquals(2, $result_id);

        // type does NOT exists so return new type's id
        $result_id = $this->_model->insertType(array('name' => 'Townhouse'));
        $this->assertEquals(5, $result_id);
    }

    public function testGetAccommodations() {
         $type = $this->_model->findByValue('Room');
         $accs = $type->getAccommodations();
         $this->assertEquals(2, count($accs));
    }

}

?>
