<?php

// scripts/places.php

/**
 * Script for creating and loading database
 */
require_once '_init.php';

// Define some CLI options
$getopt = new Zend_Console_Getopt(array(
            'delete|d' => 'delete tables STATE, CITY, MARKER',
            'readxml|r' => 'force reading ULIC.xml even if serialized file exists',
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

// read data
//$streetsXML = simplexml_load_file('_data/ULIC_sample.xml');
$streetsXML = simplexml_load_file('_data/ULIC.xml');


$outFile = '_data/ULIC.serialized';

$uniqueStreetNames = array();

if (!file_exists($outFile) || $getopt->getOption('r')) {

// read all streets names and make sure there are unique.
    foreach ($streetsXML->catalog[0] as $row) {
        // foreach ($row->col as $col) {
        $n1Node = $row->xpath("col[@name='NAZWA_1']");
        $n2Node = $row->xpath("col[@name='NAZWA_2']");
        $cNode = $row->xpath("col[@name='CECHA']");

        $nazwa1 = (string) $n1Node[0];
        $nazwa2 = (string) $n2Node[0];
        $cecha = (string) $cNode[0];

        // don't need the following types
        if (in_array($cecha, array('inne', 'ogród', 'wyspa', 'park'))) {
            continue;
        }

        $fullName = "$cecha $nazwa2 $nazwa1";
        $fullName = preg_replace('/\s+/', ' ', $fullName);

        if (!in_array($fullName, $uniqueStreetNames)) {
            $uniqueStreetNames [] = $fullName;
        }
    }

    # save it to file 
    echo "Writing : $outFile\n";
    $fp = fopen($outFile, 'w+') or die("I could not open $outFile.");
    fwrite($fp, serialize($uniqueStreetNames));
    fclose($fp);
} elseif (file_exists($outFile)) {
    # retrieve from file 
     echo "Reading: $outFile\n";
    $uniqueStreetNames = unserialize(file_get_contents($outFile));
} else {
    die('$uniqueStreetNames not created');
}

$noOfStreets = count($uniqueStreetNames);

echo "There are $noOfStreets streets read\n";

$ind = 0;

// save to db: 
if ($getopt->getOption('d')) {

    $db = Zend_Db_Table::getDefaultAdapter();
    $db->query('TRUNCATE TABLE STREET');

    // write to database 
    $streetModel = new My_Model_Table_Street();
    foreach ($uniqueStreetNames as $street) {

        $street_id = $streetModel->insert(array('name' => $street));

        if (!is_numeric($street_id)) {
            throw new Zend_Db_Exception("Cannot insert $street");
        }

         
        echo "$ind/$noOfStreets: Just inserted street: $street\n";
        $ind++;
    }
}
