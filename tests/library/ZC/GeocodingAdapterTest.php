<?php

/**
 * Test class for ZC_GeocodingAdapterTest
 * @author: jlebensold
 */
class ZC_GeocodingAdapterTest extends ControllerTestCase {

    protected $geocoder;
    /**
     * Google Maps API key for http://zc/
     * @var string
     */
    protected $apiKey = "";

    public function setUp() {
        parent::setUp();
        $this->geocoder = new ZC_GeocodingAdapter($this->apiKey);
    }

    public function tearDown() {
        $this->geocoder = null;
    }

    /**
     * @dataProvider getCityLatAndLngProvider
     */
    public function testGetCityLatAndLng($city) {
        
        $latAndLong = $this->geocoder->getGeocodedLatitudeAndLongitude($city);
        
        $this->assertTrue(is_array($latAndLong));
        $this->assertTrue(is_double($latAndLong[0]));
        $this->assertTrue(is_double($latAndLong[1]));
        
      //  var_dump($latAndLong);
    }

    public function getCityLatAndLngProvider() {
        return array(
            array('Nowy Targ'),
            array('Wroclaw')
        );
    }

}