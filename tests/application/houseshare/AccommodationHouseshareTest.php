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

            $prefs = $acc->preferences;
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
    public function testGetRoomates1($accClass) {
        $acc = new $accClass(1);

        // var_dump($acc->user->toArray());
        // $acc->type = array('name' => 'Townhause', 'is_shared' => 1);
        //  var_dump($acc->preferences->toArray());


        $acc->preferences = array();
        $acc->features = array(
            array('acc_id' => 2, 'feat_id' => 6, 'value' => 2),
            array('acc_id' => 2, 'feat_id' => 2, 'value' => 1)
        );





        // var_dump($acc->photos->toArray());
        // var_dump($acc->save());
    }

}

?>
