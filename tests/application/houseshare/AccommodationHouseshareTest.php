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

        $acc_ids = array(1, 2);

        foreach ($acc_ids as $acc_id) {

            $acc = new $accClass($acc_id);

            /* @var $prefs My_Model_Table_Rowset_AccsPreferences */
            $prefs = $acc->preferences;

            /* @var $feats My_Model_Table_Rowset_AccsFeatures */
            $feats = $acc->features;


            $accsPrefsModel = new My_Model_Table_AccsPreferences();
            $expectedPrefs = $accsPrefsModel->fetchAll("acc_id = $acc_id");
            $this->assertEquals($expectedPrefs->toArray(), $prefs->toArray());

            $accsFeatsModel = new My_Model_Table_AccsFeatures();
            $expectedFeats = $accsFeatsModel->fetchAll("acc_id = $acc_id");
            $this->assertEquals($expectedFeats->toArray(), $feats->toArray());
        }
    }

    /**
     * @dataProvider accommodationClassProvider
     */
    public function testSetPreferencesAndFeatures($accClass) {

        $acc_ids = array(1, 2);

        foreach ($acc_ids as $acc_id) {

            $acc = new $accClass($acc_id);

            $newPrefs = array(
                array('pref_id' => 1, 'value' => 1),
                array('pref_id' => 2, 'value' => 0)
            );

            $newFeats = array(
                array('feat_id' => 1, 'value' => 1),
                array('feat_id' => 2, 'value' => 0),
                array('feat_id' => 4, 'value' => 1)
            );


            $acc->preferences = $newPrefs;
            $acc->features = $newFeats;


            $acc->save();


            $accsPrefsModel = new My_Model_Table_AccsPreferences();
            $expectedPrefs = $accsPrefsModel->fetchAll("acc_id = $acc_id");

            $expectedPrefsArray = array();
            foreach ($expectedPrefs as $pref) {
                $expectedPrefsArray [] = array(
                    'pref_id' => $pref->pref_id,
                    'value' => $pref->value
                );
            }

            $this->assertEquals($expectedPrefsArray, $newPrefs);


            $accsFeatsModel = new My_Model_Table_AccsFeatures();
            $expectedFeats = $accsFeatsModel->fetchAll("acc_id = $acc_id");

            $expectedFeatsArray = array();
            foreach ($expectedFeats as $feat) {
                $expectedFeatsArray [] = array(
                    'feat_id' => $feat->feat_id,
                    'value' => $feat->value
                );
            }

            $this->assertEquals($expectedFeatsArray, $newFeats);
        }
    }

    /**
     * @dataProvider accommodationClassProvider
     */
    public function testGetPhotos($accClass) {

        $acc_ids = array(1, 2);

        foreach ($acc_ids as $acc_id) {

            $acc = new $accClass($acc_id);

            /* @var $photos array of My_Houseshare_Photo */
            $photos = $acc->photos;

            $photoModel = new My_Model_Table_Photo();

            /* @var $photo My_Houseshare_Photo */
            foreach ($photos as $photo) {
                $photoExpected = $photoModel->find($photo->photo_id)->current();

                $this->assertEquals(
                        array(
                            $photoExpected->filename,
                            $photoExpected->getFullPath()
                        ),
                        array(
                            $photo->filename,
                            $photo->getFullPath()
                        )
                );
            }
        }
    }


    public function testAccommodationFactory() {

        // no accommodation with acc_id = 12
        $acc = My_Houseshare_Factory::accommodation(12);
        $this->assertTrue(null === $acc);

        // get Shared object since acc_id=1 is shared.
        $acc = My_Houseshare_Factory::accommodation(1);
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

        // get Shared object since acc_id=2 is shared.
        $acc = My_Houseshare_Factory::accommodation(2);
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

        // get new accommodation object
        $acc = My_Houseshare_Factory::accommodation();
        $this->assertTrue($acc instanceof My_Houseshare_Accommodation);

        // get new shared object
        // at the moment there are no special classess for room or bed type.
        // Both types are represented My_Houseshare_Shared
        $acc = My_Houseshare_Factory::room();
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

         // get new shared object
        $acc = My_Houseshare_Factory::bed();
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

        // get new shared object
        $acc = My_Houseshare_Factory::accommodation(null,'BED');
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

        // get new shared object
        $acc = My_Houseshare_Factory::accommodation(null,'ROOM');
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

    }


    /**
     * @dataProvider accommodationClassProvider
     */
    public function testGetRoomates1($accClass) {
        $acc = new $accClass(1);

//        $phpt = new PHPUnit_Extensions_PhptTestCase(
//                        __DIR__ . '/upload-layout.phpt', array('cgi' => 'php-cgi')
//        );
//        $result = $phpt->run();
//        $this->assertTrue($result->wasSuccessful());


        // var_dump($acc->user->toArray());
        // $acc->type = array('name' => 'Townhause', 'is_shared' => 1);
        //  var_dump($acc->preferences->toArray());
        // var_dump($acc->photos->toArray());
        // var_dump($acc->save());
    }

}

?>
