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
        $typeNames = array('Bed','Room', 'Appartment');
        
        foreach ($typeNames as $typeName) {
            $row = My_Model_Table_Type::getByName($typeName);
            $this->assertEquals($typeName, $row->name);
        }
        
    }


}
?>
