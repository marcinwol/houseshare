<?php
/**
 * Description of ZC_GeocodingAdapter
 *
 * @author jon
 */
class ZC_GeocodingAdapter {
    
    protected $apiKey;
    
    private function getGeocodeUri()    {
        return 'http://maps.googleapis.com/maps/api/geocode/json';
    }
    
    public function __construct($apiKey = '')   {
        $this->apiKey = $apiKey;
    }
    
    
    public function getGeocodedLatitudeAndLongitude($address, $region = 'PL')   {
        
        $client = new Zend_Http_Client();
        $client->setUri($this->getGeocodeUri());

        
        $client->setParameterGet('address',$address)
                   ->setParameterGet('sensor','false')
                   ->setParameterGet('region', $region);
       //             ->setParameterGet('key',$this->apiKey);

        $result = $client->request('GET');
        
        

        $response = Zend_Json_Decoder::decode($result->getBody(),Zend_Json::TYPE_OBJECT);
        
       
        
        if ($response->status === 'OK')  {
            return $response->results[0]->geometry->location;
        }
        
        return null;
    }
}