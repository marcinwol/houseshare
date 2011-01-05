<?php

/**
 * Description of AccommodationHouseshareTest
 *
 * @author marcin
 */
class AccommodationHouseshareTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_Accommodation';


    public function accommodationClassProvider() {
        return array(
            array('My_Houseshare_Accommodation'),
            array('My_Houseshare_Shared')
        );
    }

    /**
     * @dataProvider accommodationClassProvider
     */
    public function testGetAcc($accClass) {
        $acc = new $accClass(1);
        $row = $this->_model->find(1)->current();

        $this->assertEquals(
                array(
                    $row->title,
                    $row->price
                ),
                array(
                    $acc->title,
                    $acc->price,
                )
                );



    }

    /**
     * @dataProvider accommodationClassProvider
     */
    public function testUpdateAcc($accClass) {
        $acc = new $accClass(2);
    }

    /**
     * @dataProvider accommodationClassProvider
     */
    public function testInsertAcc($accClass) {
        $acc = new $accClass();
    }

   
    /**
     * @expectedException Zend_Db_Exception
     * @dataProvider accommodationClassProvider
     */
    public function testNoAccommodationException($accClass) {
        $acc = new $accClass(15);
    }

  

}

?>
