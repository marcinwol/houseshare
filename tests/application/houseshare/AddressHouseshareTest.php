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
     * Thus, you can update (if possible) this addres without problems
     * (i.e. do not create new address). If possible means, that addresses must be
     * unique, so if already exists new address the pre-existing addr_id is returned
     * instead of updating the current addr.
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
                    1, // addr_id not changed
                    4, // new state,
                       // because there are two refs. in city to state_id = 1
                    'Mazowieckie',
                    1, // update Krakow-> Warszawa, no change in city_id
                      // beacuse only one ref. in address to city_id = 1
                    'Warszawa',
                    5, // new zip already exists so return existing zip_id
                    '98-34a',
                    3, // new street already exists so return existing street_id
                    'Wyb. Wyspianskiego'
                )
        );
    }

    /**
     * There are two refs. in ACCOMMODATION to addr_id = 2.
     * street_id is 3 and there is only one ref. in ADDRESS to this street.
     * Thus, updating street should return street_id = 3, not create new street.
     * Then, since street_id hasn't changed the no new address is created.
     *
     * @PROBLEM THIS IS A PROBLEM BEACUSE  ONE PERSON UPDATING A STREET FOR
     * HIS/HERS ACCOMMODATION WILL UPDATE STREETS FOR ALL OTHER USERS THAT
     * USE THE SAME add_id IN THEIR ACCOMMODATIONS!!!
     */
    public function testUpdateAddress2() {

        // there are two refs. in Acc. for addr_id = 2

        $address = new My_Houseshare_Address(2);
        $address->street = "Wybrzerze Wyspianskiego";
        $row_id = $address->save();

        $this->assertEquals(
                array(
                    $row_id,
                    $address->street_id,
                ),
                array(
                    2,
                    3, // only one ref. in address to this street thus update it
                // rathar then create new one.
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

}

?>
