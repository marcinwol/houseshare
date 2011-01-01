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

    public function testInsertAddress() {

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

        $this->assertEquals($row_id, 5);
    }

}

?>
