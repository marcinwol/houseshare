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
                ),
                array(
                    "",
                    "23c",
                    "Hapden Rd",
                    "34-543",
                    "Krakow",
                    "Malopolska"
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
                ),
                array(
                    "8-A",
                    "21a",
                    "Aleja 1000 lecia",
                    "34-543",
                    "Wroclaw",
                    "Dolnoslaskie"
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
     * This time update one address (4) so that it is exacly the same as
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
        $row_id = $address->save();

        $this->assertEquals(
                array(
                    5, // the new address corresponds to the address 5
                    3,
                    3,
                    4,
                    1
                ),
                array(
                    $row_id,
                    $address->city_id,
                    $address->state_id,
                    $address->street_id,
                    $address->zip_id
                )
        );
    }



}

?>
