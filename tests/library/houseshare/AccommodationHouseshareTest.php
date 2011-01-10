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

        // get Shared object since acc_id=2 is shared.
        $acc = My_Houseshare_Factory::shared(2);
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

        // At the moment there are no special classess for room or bed type.
        // Both types are represented My_Houseshare_Shared
        // get Shared object since acc_id=2 is shared.
        $acc = My_Houseshare_Factory::room(2);
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

        // get Shared object since acc_id=2 is shared.
        $acc = My_Houseshare_Factory::bed(2);
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

        // get new accommodation object
        $acc = My_Houseshare_Factory::accommodation();
        $this->assertTrue($acc instanceof My_Houseshare_Accommodation);

        // get new shared object        
        $acc = My_Houseshare_Factory::room();
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

        // get new shared object
        $acc = My_Houseshare_Factory::bed();
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

        // get new shared object
        $acc = My_Houseshare_Factory::shared();
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

        // get new shared object
        $acc = My_Houseshare_Factory::accommodation(null, 'BED');
        $this->assertTrue($acc instanceof My_Houseshare_Shared);

        // get new shared object
        $acc = My_Houseshare_Factory::accommodation(null, 'ROOM');
        $this->assertTrue($acc instanceof My_Houseshare_Shared);
    }

    /**
     * @dataProvider accommodationClassProvider
     */
    public function testInsertAccommodation1($accClass) {

        $newAcc = new $accClass();

        $newAcc->title = "New Acc title";
        $newAcc->description = "New description";
        $newAcc->setAddrId(2);
        $newAcc->setUserId(1);
        $newAcc->date_avaliable = "2011-01-04";
        $newAcc->price = 300;
        $newAcc->bond = 1200;
        $newAcc->street_address_public = 1;
        $newAcc->short_term_ok = 0;
        $newAcc->setTypeId(1);

        $acc_id = $newAcc->save();

        $expectedAcc_id = 4;

        $accRow = $this->_model->find($acc_id)->current();

        $this->assertEquals(
                array($expectedAcc_id, 'New Acc title'),
                array($acc_id, $accRow->title)
        );
    }

    /**
     * @dataProvider accommodationClassProvider
     */
    public function testUpdateAccommodation1($accClass) {

        $accRowBefore = $this->_model->find(2)->current();

        $newAcc = new $accClass(2);

        $newAcc->title = "New Acc title";
        $newAcc->setAddrId(2);
        $newAcc->setUserId(1);
        $newAcc->date_avaliable = "2011-01-04";
        $newAcc->bond = 1200;
        $newAcc->setTypeId(2);

        $acc_id = $newAcc->save();

        $expectedAcc_id = 2;

        $accRowAfter = $this->_model->find($expectedAcc_id)->current();

        $this->assertEquals(
                array(
                    $expectedAcc_id,
                    'New Acc title',
                    $accRowBefore->description,
                    $accRowBefore->price,
                    1200,
                    2
                ),
                array(
                    $acc_id,
                    $accRowAfter->title,
                    $accRowAfter->description,
                    $accRowAfter->price,
                    $accRowAfter->bond,
                    $accRowAfter->type_id
                )
        );
    }

    /**
     * @dataProvider accommodationClassProvider
     */
    public function testDeleteAccommodation1($accClass) {
        $newAcc = new $accClass(2);
        $newAcc->delete();

        $accRowAfter = $this->_model->find(2)->current();
        $this->assertTrue(null === $accRowAfter);

        $accClass::deleteAcc(3);

        $accRowAfter = $this->_model->find(3)->current();
        $this->assertTrue(null === $accRowAfter);
    }

    /**
     * @dataProvider accommodationClassProvider
     */
    public function testInsertAccWithFeaturesAndPreferencesAndPhotos($accClass) {

        // create new accommodation
        $newAcc = new $accClass();

        // set basic accommodation info
        $newAcc->title = "New Acc title";
        $newAcc->description = "New description";
        $newAcc->setAddrId(2);
        $newAcc->setUserId(1);
        $newAcc->date_avaliable = "2011-01-04";
        $newAcc->price = 300;
        $newAcc->bond = 1200;
        $newAcc->street_address_public = 1;
        $newAcc->short_term_ok = 0;
        $newAcc->setTypeId(1);

        $acc_id = $newAcc->save();
        // the save method will repopulate variabiles in $newAcc object
        // which will make possible to save features, preferces and photos.
        //add some features and preferences

        $this->assertEquals(4, $acc_id);

        $newPrefs = array(
            array('pref_id' => 1, 'value' => 1),
            array('pref_id' => 2, 'value' => 0)
        );

        $newFeats = array(
            array('feat_id' => 1, 'value' => 1),
            array('feat_id' => 2, 'value' => 0),
            array('feat_id' => 4, 'value' => 1)
        );

        $newAcc->features = $newFeats;
        $newAcc->preferences = $newPrefs;


        $photo1 = new My_Houseshare_Photo();
        $photo1->filename = "finemale1.jpg";
        $photo1->path = 'new_path/sadf/';
        $photo1->setAccId($acc_id);

        $photo2 = new My_Houseshare_Photo();
        $photo2->filename = "finemale2.jpg";
        $photo2->setPathId(2);
        $photo2->setAccId($acc_id);

        $photo3 = new My_Houseshare_Photo();
        $photo3->filename = "finemale3.jpg";
        $photo3->setPathId(1);
        $photo3->setAccId($acc_id);

        $newAcc->photos = array($photo1, $photo2, $photo3);

        $newAcc->save();



        // now assert if preferences and features were saved correctly
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

        // finally check if photos were inserted
        $photoModel = new My_Model_Table_Photo();
        $expectedPhotos = $photoModel->fetchAll("acc_id = $acc_id");

        $this->assertEquals(3, count($expectedPhotos));
    }

}

?>