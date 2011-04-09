<?php
/**
 * Description of ZC_GeocodingAdapter
 *
 * @author jon
 */
class ZC_GeocodingAdapter {
    protected $apiKey;
    
    private function getGeocodeUri()    {
        return 'http://maps.google.com/maps/geo';
    }
    
    public function __construct($apiKey = '')   {
        $this->apiKey = $apiKey;
    }
    
    
    public function getGeocodedLatitudeAndLongitude($address, $region = 'PL')   {
        
        $client = new Zend_Http_Client();
        $client->setUri($this->getGeocodeUri());
        
        $client->setParameterGet('q',urlencode($address))
                   ->setParameterGet('output','json')
                   ->setParameterGet('sensor','false')
                   ->setParameterGet('retion', $region);
       //             ->setParameterGet('key',$this->apiKey);

        $result = $client->request('GET');

        $response = Zend_Json_Decoder::decode($result->getBody(),Zend_Json::TYPE_OBJECT);

        if ($response instanceof stdClass)  {
            return $response->Placemark[0]->Point->coordinates;
        }
    }
}