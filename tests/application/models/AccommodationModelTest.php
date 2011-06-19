<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AccommodationModelTest
 *
 * @author marcin
 */
class AccommodationModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_Accommodation';

    /**
     * @dataProvider setAccommodationDataProvider
     */
    public function testSetAccommodation($data, $id, $expectedID) {
        // if $id === null than create new Accommodation,
        //  otherwise update current user
        $acc_id = $this->_model->setAccommodation($data, $id);
        $this->assertEquals($expectedID, $acc_id);

        $userData = $this->_model->find($acc_id)->current()->toArray();

        $this->assertEquals(
                array(
                    $data['title'],
                    $data['description'],
                    $data['addr_id'],
                    $data['features_id'],
                    $data['preferences_id'],
                    $data['price'],
                    $data['user_id'],
                    $data['date_avaliable'],
                    $data['type_id'],
                    $data['street_address_public'],                                        
                    
                ), array(
                    $userData['title'],
                    $userData['description'],
                    $userData['addr_id'],
                    $userData['features_id'],
                    $userData['preferences_id'],
                    $userData['price'],
                    $userData['user_id'],
                    $userData['date_avaliable'],
                    $userData['type_id'],
                    $userData['street_address_public'],  
                )
        );
    }

    public function setAccommodationDataProvider() {

        $argSet = array();

        $argSet[] = array(
            array(
                'title' => 'some title',
                'description' => 'some description',
                'addr_id' => 2,
                'user_id' => 2,
                'date_avaliable' => '2011-12-12',
                'price' => 300,
                'price_info' => 'does not include gas and electricity',
                'preferences_info' => 'students most welcome',
                'features_info' => 'very fast internet',
                'bond' => 1200,
                'street_address_public' => 1,               
                'short_term_ok' => 1,
                'type_id' => 2,
                'features_id' => 1,
                'preferences_id' => 1
            ),
            null, // create new Accommodation
            6     // expected id of the new Accommodation
        );

        $argSet[] = array(
            array(
                'title' => 'some title 2 ',
                'description' => 'some description 2',
                'price_info' => 'includs everything',
                'addr_id' => 2,
                'user_id' => 2,
                'date_avaliable' => '2011-12-12',                                
                'price' => 300,
                'bond' => 1200,
                'street_address_public' => 1,
                'short_term_ok' => 1,
                'type_id' => 1,
                'features_id' => 2,
                'preferences_id' => 3
            ),
            2, // update new Accommodation with id = 2
            2   // expected id is 2 (just update, no new Accommodation)
        );



        $accData = $this->_getAccommodationModel()->find(3)->current()->toArray();

        unset($accData['acc_id']);
        unset($accData['created']);
        unset($accData['is_enabled']);
        unset($accData['queries_counter']);

        // change only date and short_term
        $accData['date_avaliable'] = '2011-02-12';
        $accData['short_term_ok'] = 1;

        $argSet[] = array(
            $accData,
            3, // update new Accommodation with id = 3
            3  // expected id is 3 (just update, no new Accommodation)
        );

        return $argSet;
    }

    /**
     * Gets Accommodation model
     *
     * @return My_Model_Table_Accommodation
     */
    protected function _getAccommodationModel() {
        $this->setUp();
        return $this->_model;
    }

    /**
     * @expectedException Zend_Db_Statement_Exception
     */
    public function testThrowException() {

        // addr_id and user_id don't exist.
        // thus throw exception (about referential integrity).

        $data = array(
            'title' => 'some title',
            'description' => 'some description',
            'addr_id' => 14,
            'user_id' => 14,
            'date_avaliable' => '2011-12-12',
            'price' => 300,
            'price_info' => 'does not include gas and electricity',
            'features_id' => 2,
            'preferences_id' => 2,
            'bond' => 1200,
            'street_address_public' => 1,
            'short_term_ok' => 1,
            'type_id' => 3
        );

        // create new user
        $user_id = $this->_model->setAccommodation($data, null);
    }

    /**
     * @dataProvider getAddressDataProvider
     */
    public function testGetAddress($acc_id, $expected) {

        $row = $this->_model->find($acc_id)->current();
        $this->assertEquals(
                array(
            $expected['street_no'],
            $expected['street_name'],
            $expected['zip'],
            $expected['city_name'],
            $expected['state_name'],
                ), array(
            $row->getAddress()->street_no,
            $row->getAddress()->getStreet()->name,
            $row->getAddress()->getZip()->value,
            $row->getAddress()->getCity()->name,
            $row->getAddress()->getState()->name
                )
        );
    }

    public function getAddressDataProvider() {
        return array(
            array(
                1, //acc_id
                array(// expected data
                    'street_no' => '23c',
                    'street_name' => 'Hapden Rd',
                    'zip' => '34-543',
                    'city_name' => 'Krakow',
                    'state_name' => 'Malopolska'
                )
            ),
            array(
                3, //acc_id
                array(// expected data
                    'street_no' => '212',
                    'street_name' => 'Wyb. Wyspianskiego',
                    'zip' => '98-34a',
                    'city_name' => 'Wroclaw',
                    'state_name' => 'Dolnoslaskie'
                )
            )
        );
    }

    /**
     * @dataProvider getUserDataProvider
     */
    public function testGetUser($acc_id, $expected) {

        $row = $this->_model->find($acc_id)->current();
        $this->assertEquals(
                array(
            $expected['first_name'],
            $expected['last_name']
                ), array(
            $row->getUser()->first_name,
            $row->getUser()->last_name
                )
        );
    }

    public function getUserDataProvider() {
        return array(
            array(
                1, //acc_id
                array(// expected data
                    'first_name' => 'Marcin',
                    'last_name' => 'Wolski'
                )
            ),
            array(
                3, //acc_id
                array(// expected data
                    'first_name' => 'Michal',
                    'last_name' => 'Chojcan'
                )
            )
        );
    }

    public function testCountPhotos() {
        $row = $this->_model->find(1)->current();
        $this->assertEquals(3, count($row->getPhotos()));

        $row = $this->_model->find(2)->current();
        $this->assertEquals(0, count($row->getPhotos()));

        $row = $this->_model->find(3)->current();
        $this->assertEquals(2, count($row->getPhotos()));
    }

    /**
     * @dataProvider getPhotoPathsProvider
     */
    public function testGetPhotoPaths($acc_id, $expected_ids) {
        $accRow = $this->_model->find($acc_id)->current();
        $photoPaths = $accRow->getPhotoPaths();


        // get only photo ids
        $photo_ids = My_Houseshare_Tools::getSLValsInArray($photoPaths, 'photo_id');

        $this->assertEquals($expected_ids, $photo_ids);
    }

    public function getPhotoPathsProvider() {
        return array(
            array(1, array(1, 2, 3)),
            array(2, array()),
            array(3, array(7, 8))
        );
    }

    public function testGetFeatures() {
        $accRow = $this->_model->find(1)->current();
        $row = $accRow->getFeatures();
        $this->assertEquals(1, $row->features_id);

        $accRow = $this->_model->find(3)->current();
        $row = $accRow->getFeatures();
        $this->assertEquals(3, $row->features_id);
    }

    public function testGetPreferences() {
        $accRow = $this->_model->find(1)->current();
        $row = $accRow->getPreferences();
        $this->assertEquals(1, $row->preferences_id);

        $accRow = $this->_model->find(3)->current();
        $row = $accRow->getPreferences();
        $this->assertEquals(3, $row->preferences_id);
    }

    /**
     * @dataProvider getSharedAccProvider
     */
    public function testGetSharedAcc($acc_id, $expected) {
        $accRow = $this->_model->find($acc_id)->current();
        $result = $accRow->getShared();

        $this->assertEquals(
                array($expected['acc_id'], $expected['roomates_id']), array($result->acc_id, $result->roomates_id)
        );
    }

    public function getSharedAccProvider() {
        return array(
            array(1, array('acc_id' => 1, 'roomates_id' => null)),
            array(2, array('acc_id' => 2, 'roomates_id' => 1)),
            array(3, array('acc_id' => 3, 'roomates_id' => null))
        );
    }

    /**
     * We should be able to delete preferences or features
     * 
     * @expectedException Zend_Db_Statement_Exception
     * @dataProvider deletePreferencesProvider
     */
    public function testDeletePreferences($acc_id) {
        $accRow = $this->_model->find($acc_id)->current();
        $result = $accRow->detelePreferences();
        
    }

    public function deletePreferencesProvider() {
        return array(
            array(1)        
        );
    }

    /**
     * We should be able to delete preferences or features
     * 
     * @expectedException Zend_Db_Statement_Exception
     * @dataProvider deleteFeaturesProvider
     */
    public function testDeleteFeatures($acc_id) {
        $accRow = $this->_model->find($acc_id)->current();
        $result = $accRow->deteleFeatures();
        
    

    }

    public function deleteFeaturesProvider() {
        return array(
            array(1)
        );
    }

}

?>
