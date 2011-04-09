<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of AddressHouseshareTest
 *
 * @author marcin
 */
class AddressHouseshareTest extends ModelTestCase {

    public function testGetAddress() {

        $address = new My_Houseshare_Address(1);

        $this->assertEquals(
                array(
                    $address->unit_no,
                    $address->street_no,
                    $address->street,
                    $address->zip,
                    $address->city,
                    $address->state,
                    $address->lat,
                    $address->lng,
                ),
                array(
                    "",
                    "23c",
                    "Hapden Rd",
                    "34-543",
                    "Krakow",
                    "Malopolska",
                    '49.430099',
                    '20.012501'                    
                )
        );


        $address = new My_Houseshare_Address(4);

        $this->assertEquals(
                array(
                    $address->unit_no,
                    $address->street_no,
                    $address->street,
                    $address->zip,
                    $address->city,
                    $address->state,
                    $address->lat,
                    $address->lng,                    
                ),
                array(
                    "8-A",
                    "21a",
                    "Aleja 1000 lecia",
                    "34-543",
                    "Wroclaw",
                    "Dolnoslaskie",
                    '50.430099',
                    '18.022499'
                )
        );
        
        // now check null marker
        $address = new My_Houseshare_Address(2);

        $this->assertEquals(
                array(
                    empty($address->lat),
                    empty($address->lng),                    
                ),
                array(
                    true,
                    true
                )
        );
        
        
    }

    public function testInsertAddress1() {

        // first check what happen if we want to insert existing address
        // it should return existing address's id
        $address = new My_Houseshare_Address();
        $address->unit_no = "8-A";
        $address->street_no = "21a";
        $address->street = "Aleja 1000 lecia";
        $address->zip = "34-543";
        $address->city = "Wroclaw";
        $address->state = "Dolnoslaskie";
        $row_id = $address->save();

        $this->assertEquals($row_id, 4);

        // check inserting fully new address and check state of database tables.
        $address = new My_Houseshare_Address();
        $address->unit_no = "9";
        $address->street_no = "222";
        $address->street = "Aleja 2000 lecia";
        $address->zip = "44-543";
        $address->city = "Warszawa";
        $address->state = "Mazowieckie";
        $row_id = $address->save();

        $this->assertEquals(
                array(
                    $row_id,
                    $address->state_id,
                    $address->state,
                    $address->city_id,
                    $address->city,
                    $address->zip_id,
                    $address->zip,
                    $address->street_id,
                    $address->street,
                ),
                array(
                    6,
                    4,
                    'Mazowieckie',
                    4,
                    'Warszawa',
                    6,
                    '44-543',
                    5,
                    'Aleja 2000 lecia'
                )
        );


        // after that check updating new address.
        $address = new My_Houseshare_Address(2);
        $address->street = 'Aleja 2000 lecia';
        $row_id = $address->save();
        $this->assertEquals(
                array(
                    $row_id,
                ),
                array(
                    7, // this should be new ID since there are more than
                // one refs. in Accommodation to address of ID=2.
                // Thus we don't want to update the address for other
                // accommodations.
                )
        );
    }

    /**
     * There is one ref. in ACCOMMODATION to addr_id = 1.
     */
    public function testUpdateAddress1() {
    
        $address = new My_Houseshare_Address(1);
        $address->unit_no = "9";
        $address->street_no = "222";
        $address->street = "Wyb. Wyspianskiego";
        $address->zip = "98-34a";
        $address->city = "Warszawa";
        $address->state = "Mazowieckie";
        $row_id = $address->save();

        $this->assertEquals(                
                array(
                    6, // address change so make new one.
                    4, // new state,
                       // because there are two refs. in city to state_id = 1
                    'Mazowieckie',
                    4, // new city
                    'Warszawa',
                    5, // new zip already exists so return existing zip_id
                    '98-34a',
                    3, // new street already exists so return existing street_id
                    'Wyb. Wyspianskiego'
                ),
                array(
                    $row_id,
                    $address->state_id,
                    $address->state,
                    $address->city_id,
                    $address->city,
                    $address->zip_id,
                    $address->zip,
                    $address->street_id,
                    $address->street,
                )
        );
    }

    /**
     * There are two refs. in ACCOMMODATION to addr_id = 2.
     * street_id is 3 and there is only one ref. in ADDRESS to this street.
     */
    public function testUpdateAddress2() {

        $address = new My_Houseshare_Address(2);
        $address->street = "Wybrzerze Wyspianskiego";
        $row_id = $address->save();

        $this->assertEquals(
                array(
                    6, // new address since new street
                    5, // new street.
                ),
                array(
                    $row_id,
                    $address->street_id,
                )                
        );
    }

    public function testUpdateAddress3() {

        // there are two refs. in Acc. for addr_id = 2
        $address = new My_Houseshare_Address(2);
        $address->city = "Wroclawek";
        $row_id = $address->save();

        $this->assertEquals(
                array(
                    $row_id,
                    $address->city_id,
                ),
                array(
                    6, // since there there are two ref. in acc to addr_id =2
                    //  create new address
                    4, // three refs. in address to wroclaw so insert new city.
                )
        );
    }

    /**
     * This time update one address (4) so that it is exactly the same as
     * address (5). Thus instead of creating new data, just return address 5.
     */
     public function testUpdateAddress4() {

        $address = new My_Houseshare_Address(4);
        $address->unit_no = "18";
        $address->street_no = "1a";
        $address->street = "Aleja 1000 lecia";
        $address->zip = "34-543";
        $address->city = "Wroclaw";
        $address->state = "Dolnoslaskie";
        $address->lat = '50.430099';  // set no marker for this address
        $address->lng = '18.022499';  // set no marker for this address
        $row_id = $address->save();

        $this->assertEquals(
                array(
                    5, // the new address corresponds to the address 5
                    3,
                    3,
                    4,
                    1,
                    5 // marker was removed
                ),
                array(
                    $row_id,
                    $address->city_id,
                    $address->state_id,
                    $address->street_id,
                    $address->zip_id,
                    $address->marker_id
                )
        );
    }
    
    
     public function testInsertAddress1WithMarker() {

        // first check what happen if we want to insert existing address
        // it should return existing address's id
        $address = new My_Houseshare_Address();
        $address->unit_no = "8-A";
        $address->street_no = "21a";
        $address->street = "Aleja 1000 lecia";
        $address->zip = "34-543";
        $address->city = "Wroclaw";
        $address->state = "Dolnoslaskie";
        $address->lat = "50.430099";
        $address->lng = "18.022499";
        $row_id = $address->save();
        
        $this->assertEquals(4,$row_id);

        
        
        // check inserting new address with EXISTING marker.
        $address = new My_Houseshare_Address();
        $address->unit_no = "9";
        $address->street_no = "222";
        $address->street = "Aleja 2000 lecia";
        $address->zip = "44-543";
        $address->city = "Warszawa";
        $address->state = "Mazowieckie";
        $address->lat = "50.430099"; // this marker already exists (i.e. marker_id = 5)
        $address->lng = "18.022499";
        $row_id = $address->save();

        $this->assertEquals(
                array(
                    6,
                    4,
                    'Mazowieckie',
                    4,
                    'Warszawa',
                    6,
                    '44-543',
                    5,
                    'Aleja 2000 lecia',
                    5, //expected marker_id        
                    '50.430099',
                    '18.022499'
                ),
                array(
                    $row_id,
                    $address->state_id,
                    $address->state,
                    $address->city_id,
                    $address->city,
                    $address->zip_id,
                    $address->zip,
                    $address->street_id,
                    $address->street,
                    $address->marker_id,
                    $address->lat,
                    $address->lng
                )
        );
//
//
//        // after that check updating new address.
//        $address = new My_Houseshare_Address(2);
//        $address->street = 'Aleja 2000 lecia';
//        $row_id = $address->save();
//        $this->assertEquals(
//                array(
//                    $row_id,
//                ),
//                array(
//                    7, // this should be new ID since there are more than
//                // one refs. in Accommodation to address of ID=2.
//                // Thus we don't want to update the address for other
//                // accommodations.
//                )
//        );
    }

    
    public function testInsertAddress2WithMarker() {

        
        // check inserting new address with NEW marker.
        $address = new My_Houseshare_Address();
        $address->unit_no = "9";
        $address->street_no = "222";
        $address->street = "Aleja 2000 lecia";
        $address->zip = "44-543";
        $address->city = "Warszawa";
        $address->state = "Mazowieckie";
        $address->lat = "51.230099"; // this marker is new (it should be 6)
        $address->lng = "28.122499";
        $row_id = $address->save();

        $this->assertEquals(
                array(
                    6, // expected new addr_id
                    4,
                    'Mazowieckie',
                    4,
                    'Warszawa',
                    6,
                    '44-543',
                    5,
                    'Aleja 2000 lecia',
                    6, //expected marker_id        
                    '51.230099',
                    '28.122499'
                ),
                array(
                    $row_id,
                    $address->state_id,
                    $address->state,
                    $address->city_id,
                    $address->city,
                    $address->zip_id,
                    $address->zip,
                    $address->street_id,
                    $address->street,
                    $address->marker_id,
                    $address->lat,
                    $address->lng
                )
        );
        
        
        
        
        // check inserting same address but with NEW marker.
        // I expect new addr_id and new marker_id
        $address = new My_Houseshare_Address();
        $address->unit_no = "9";
        $address->street_no = "222";
        $address->street = "Aleja 2000 lecia";
        $address->zip = "44-543";
        $address->city = "Warszawa";
        $address->state = "Mazowieckie";
        $address->lat = "31.230099"; // this marker is new (it should be 6)
        $address->lng = "48.122499";
        $row_id = $address->save();

        $this->assertEquals(
                array(
                    7, // expected new addr_id
                    4,
                    'Mazowieckie',
                    4,
                    'Warszawa',
                    6,
                    '44-543',
                    5,
                    'Aleja 2000 lecia',
                    7, //expected marker_id        
                    '31.230099',
                    '48.122498' // small error due to float numbers
                ),
                array(
                    $row_id,
                    $address->state_id,
                    $address->state,
                    $address->city_id,
                    $address->city,
                    $address->zip_id,
                    $address->zip,
                    $address->street_id,
                    $address->street,
                    $address->marker_id,
                    $address->lat,
                    $address->lng
                )
        );
          
    }
    
    
     /**
     * There is one ref. in ACCOMMODATION to addr_id = 1.
     */
    public function testUpdateAddress1WithMarker() {
    
        $address = new My_Houseshare_Address(1);
        $address->unit_no = "9";
        $address->street_no = "222";
        $address->street = "Wyb. Wyspianskiego";
        $address->zip = "98-34a";
        $address->city = "Warszawa";
        $address->state = "Mazowieckie";
        
        // do not change marker
        
        $row_id = $address->save();

        $this->assertEquals(                
                array(
                    6, // address change so make new one.
                    4, // new state,
                       // because there are two refs. in city to state_id = 1
                    'Mazowieckie',
                    4, // new city
                    'Warszawa',
                    5, // new zip already exists so return existing zip_id
                    '98-34a',
                    3, // new street already exists so return existing street_id
                    'Wyb. Wyspianskiego',
                    4 // marker was not changed
                ),
                array(
                    $row_id,
                    $address->state_id,
                    $address->state,
                    $address->city_id,
                    $address->city,
                    $address->zip_id,
                    $address->zip,
                    $address->street_id,
                    $address->street,
                    $address->marker_id
                )
        );
    }

    /**
     * There are two refs. in ACCOMMODATION to addr_id = 2.
     * street_id is 3 and there is only one ref. in ADDRESS to this street.
     */
    public function testUpdateAddress2WithMarker() {

        $address = new My_Houseshare_Address(2);
        $address->street = "Wybrzerze Wyspianskiego";        
        $address->lat = '44.123456'; // make a marker for this acc as it does not have it yet
        $address->lng = '14.222222';
        
        $row_id = $address->save();

        $this->assertEquals(
                array(
                    6, // new address since new street
                    5, // new street.
                    6, // new marker
                ),
                array(
                    $row_id,
                    $address->street_id,
                    $address->marker_id
                )                
        );
    }

    public function testUpdateAddress3WithMarker() {

        // there are two refs. in Acc. for addr_id = 2
        $address = new My_Houseshare_Address(2);
        $address->city = "Wroclawek";
        $address->lat = "50.430099"; // make marker for this acc but 
        $address->lng = "18.022499"; // this marker already exists (i.e. marker_id = 5)
        $row_id = $address->save();

        $this->assertEquals(
                 array(
                    6, // since there there are two ref. in acc to addr_id =2
                       //  create new address
                    4, // three refs. in address to wroclaw so insert new city.
                    5  // existing marker_id
                ),
                array(
                    $row_id,
                    $address->city_id,
                    $address->marker_id
                )
               
        );
    }

    /**
     * Just change the marker
     */
     public function testUpdateAddress4WithMarker() {

        $address = new My_Houseshare_Address(4);      
        $address->lat = '12.123567';  // change marker
        $address->lng = '22.123567';   
        $row_id = $address->save(true); // use updateAddress instead of insertAddress

        $this->assertEquals(
                array(
                    4, // do not create new address
                    6  // expected new marker_id
                ),
                array(
                    $row_id,                    
                    $address->marker_id
                )
        );
    }



}

?>
