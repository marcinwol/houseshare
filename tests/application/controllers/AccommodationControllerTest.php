<?php

class AccommodationControllerTest extends ControllerTestCase {

    public function testIndexAction() {
        $this->dispatch('/accommodation/');
        $this->assertController('accommodation');
        $this->assertAction('index');
    }

    /**
     *
     * @dataProvider addAccommodationProvider
     * @param array $postData
     */
    public function testAddAccommodationSuccessfull($postData) {
        $this->request->setPost($postData)->setMethod('POST');
        $this->dispatch('/accommodation/add');
       

        // expected user id is 4
        $user = My_Houseshare_Factory::roomate(4);

        $this->assertEquals(
                array(
                    'marcin',
                    0
                ),
                array(
                    $user->first_name,
                    $user->last_name_public
                )
        );

        // expected address id is 6
        $address = new My_Houseshare_Address(6);
        $this->assertEquals(
                array(
                    '',
                    'Aleja Zamonska',
                    'Wroclaw'
                ),
                array(
                    $address->unit_no,
                    $address->street,
                    $address->city
                )
        );

        // expected roomates id is 4
        $roomatesModel = new My_Model_Table_Roomates();
        $roomates = $roomatesModel->find(4)->current();

        $this->assertEquals(
                array(
                    4,
                    2
                ),
                array(
                    $roomates->no_roomates,
                    $roomates->gender
                )
        );

        // expected accommodation id is 4
        $acc = My_Houseshare_Factory::shared(4);

        $this->assertEquals(
                array(
                    4,
                    'Great room for rent in quite place'
                ),
                array(
                    $acc->roomates_id,
                    $acc->title
                )
        );

        // check expected number of preferences
        $this->assertEquals(5, count($acc->features));
        $this->assertEquals(3, count($acc->preferences));

        // check if session variablec acc_id was created
        $addAccInfoNamespace = new Zend_Session_Namespace('addAccInfo');
        $this->assertEquals(4, $addAccInfoNamespace->acc_id);

        // finally check if user is redirected to addphotos
        $this->assertRedirectTo('/accommodation/addphotos');
    }

    public function addAccommodationProvider() {
        return array(
            array(
                array(// correct form data
                    'basic_info' => array(
                        'acc_type' => 1,
                        'title' => 'Great room for rent in quite place',
                        'description' => "Description of the accommodation",
                        'date_avaliable' => "13/01/2011",
                        'short_term' => 1,
                        'price' => 323,
                        'bond' => 1232
                    ),
                    'address' => array(
                        'unit_no' => '',
                        'street_no' => '34a',
                        'address_public' => 0,
                        'street_name' => 'Aleja Zamonska',
                        'zip' => '34-234',
                        'city' => 'Wroclaw',
                        'state' => 'Dolnoslaskie'
                    ),
                    'roomates' => array(
                        'no_roomates' => 4,
                        'gender' => 2,
                        'min_age' => 20,
                        'max_age' => 35
                    ),
                    'preferences' => array(
                        'smokers' => 1,
                        'kids' => -1,
                        'couples' => 3,
                        'pets' => -1,
                        'gender' => 1
                    ),
                    'acc_features' => array(
                        'internet' => 1,
                        'parking' => -1,
                        'tv' => 3,
                        'airconditioning' => 5,
                        'furnished' => 2
                    ),
                    'room_features' => array(
                        'privatebath' => -1,
                        'privatebalcony' => 7
                    ),
                    'about_you' => array(
                        'first_name' => 'marcin',
                        'last_name' => 'wolski',
                        'last_name_public' => 0,
                        'phone_no' => '+234 234 243',
                        'phone_public' => 1,
                        'email' => 'marcin@test.com',
                        'password1' => 'haslo12',
                        'password2' => 'haslo12'
                    )
                )
            )
        );
    }

}

