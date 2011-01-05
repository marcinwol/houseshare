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
        
        // fetch acc row using model for comparison
        $row = $this->_model->find(1)->current();

        $this->assertEquals(
                array(
                    $row->title,
                    $row->price
                ),
                array(
                    $acc->title,
                    $acc->price,
                )  // var_dump($acc->getProperties());
        );
    }


     /**
     * @dataProvider accommodationClassProvider
     */
    public function testGetPreferencesAndFeatures($accClass) {
        $acc = new $accClass(1);

       // var_dump($acc->type->toArray());

    }

     /**
     * @dataProvider accommodationClassProvider
     */
    public function testGetRoomates1($accClass) {
        $acc = new $accClass(2);

       // var_dump($acc->user->toArray());
       // $acc->type = array('name' => 'Townhause', 'is_shared' => 1);

        var_dump($acc->preferences->toArray());


        $acc->preferences = array(
            array(
                'acc_id' => 2,
                'pref_id' => 2,
                'value' => 0
            ),
        );

        $acc->save();

    }

}

?>
