<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CityModelTest
 *
 * @author marcin
 */
class MarkerModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_Marker';

    /**
     * @dataProvider insertMarkerProvider
     */
    public function testInsertMarker($lat, $lng, $expMarkerId) {
        $id = $this->_model->insertMarker(array(
                    'lat' => $lat,
                    'lng' => $lng
                ));
        $this->assertEquals($expMarkerId, $id);
    }

    public function insertMarkerProvider() {
        return array(
            array('50.074799', '19.947701', 1), //exhisting marker            
            array('23.947701', '59.947701', 6), // new marker            
        );
    }

    /**
     * @dataProvider updateMarkerProvider
     */
    public function testUpdateMarker($markerId, $lat, $lng, $expMarkerId) {
        $id = $this->_model->updateMarker(
                        array('lat' => $lat, 'lng' => $lng), $markerId
        );
        $this->assertEquals($expMarkerId, $id);
    }

    public function updateMarkerProvider() {
        return array(
            array(1, '52.074799','62.074799', 1), //only one reference 
            array(2, '49.480099','20.032499', 3), //only one reference 
        );
    }


}

?>
