<?php

// scripts/places.php

/**
 * Script for creating and loading database
 */
require_once '_init.php';

// Define some CLI options
$getopt = new Zend_Console_Getopt(array(
            'delete|d' => 'delete tables STATE, CITY, MARKER',
            'markers|m-i' => 'query google map for marker and save into db (default 10 markers)',
            'env|e-s' => 'Application environment for which to create database (defaults to development)',
            'help|h' => 'Help -- usage message',
        ));

try {
    $getopt->parse();
} catch (Zend_Console_Getopt_Exception $e) {
    // Bad options passed: report usage
    echo $e->getUsageMessage();
    return false;
}

// If help requested, report usage message
if ($getopt->getOption('h')) {
    echo $getopt->getUsageMessage();
    return true;
}

// Initialize values based on presence or absence of CLI options
$withData = $getopt->getOption('w');
$env = $getopt->getOption('e');

defined('APPLICATION_ENV')
        || define('APPLICATION_ENV', (null === $env) ? 'development' : $env);

// Initialize Zend_Application
$application = new Zend_Application(
                APPLICATION_ENV,
                APPLICATION_PATH . '/configs/application.ini'
);

// Bootstrap everything
$bootstrap = $application->bootstrap();

function getDataFromCSV($file, $sep = ';') {
    $out = array();
    if (($handle = fopen($file, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 0, $sep)) !== FALSE) {
            $out [] = $data;
        }
        fclose($handle);
    }
    return $out;
}

if ($getopt->getOption('d')) {

    $db = Zend_Db_Table::getDefaultAdapter();
    $db->query('TRUNCATE TABLE CITY');
    $db->query('TRUNCATE TABLE MARKER');
    $db->query('TRUNCATE TABLE STATE');



    // read data
    $states = getDataFromCSV('_data/provinces.csv');
    $cities = getDataFromCSV('_data/places.csv',',');

    // write states into db
    $stateModel = new My_Model_Table_State();
    foreach ($states as $state) {
        $stateModel->insert(
                array(
                    'state_id' => $state[0],
                    'name' => $state[1]
                )
        );
    }

    $noOfCities = count($cities);
    $ind = 0;
    
    // write cities into db
    $cityModel = new My_Model_Table_City();
    foreach ($cities as $city) {
        $cityModel->insert(
                array(
                    'city_id' => $city[0],
                    'state_id' => $city[1],
                    'name' => $city[2],
                    'alt_name' => (isset($city[3])?$city[3]:''),
                    'main' => (isset($city[4])?$city[4]:0)
                )
        );
        
        echo "$ind/$noOfCities: Just inserted city: {$city[2]}\n";
        $ind++;
        
    }
}

$marker = $getopt->getOption('m');

// ask google  map for localization of cities
if ($marker) {

    $markerValue = (is_numeric($marker) ? (int) $marker : 2);

    if (!isset($cityModel)) {
        $cityModel = new My_Model_Table_City();
    }

    $select = $cityModel->select()->where(new Zend_Db_Expr('marker_id IS NULL'));
    $result = $cityModel->fetchAll($select);

    if ($result->count() == 0) {
        echo "All {$result->count()} have markers \n";
    }


    // create google gecoder object
    $geocoder = new ZC_GeocodingAdapter();


    $markerModel = new My_Model_Table_Marker();

    for ($i = 0; $i < $markerValue; $i++) {
        $cityId = $result[$i]->city_id;
        $cityName = $result[$i]->name;
        $stateName = $result[$i]->getState()->name;
        $address = "$cityName, $stateName";

        $loc = $geocoder->getGeocodedLatitudeAndLongitude($address);

        if (is_null($loc)) {
            echo "Cannot find lat and lng for $address \n";
            continue;
        }

        $marker_id = $markerModel->insert(array('lat' => $loc->lat, 'lng' => $loc->lng));

        if (!is_numeric($marker_id)) {
            throw new Zend_Db_Exception($marker_id . " is not an integer!");
        }


        // update city with just created marker_id                
        $noOfUpdates = $cityModel->update(array('marker_id' => $marker_id), array('city_id = ?' => $cityId));

        if (1 != $noOfUpdates) {
            throw new Zend_Db_Exception("Updated more then one city row!");
        }
        
        echo "$i: Localization found for $address \n";
       
        sleep(3);
    }
}
?>