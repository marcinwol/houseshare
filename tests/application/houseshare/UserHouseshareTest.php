<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserHoueshareTest
 *
 * @author marcin
 */
class UserHouseshareTest extends ModelTestCase {

    public function testGetUser() {
        $user = new My_Houseshare_User(1);

        $this->assertEquals(
                array(
                    'Marcin',
                    'Wolski'
                ),
                array(
                    $user->first_name,
                    $user->last_name
                )
        );

        $user = new My_Houseshare_User(2);
        $this->assertEquals(
                array(
                    'Michal',
                    'Chojcan'
                ),
                array(
                    $user->first_name,
                    $user->last_name
                )
        );
    }

    public function testInsertUser() {
        $user = new My_Houseshare_User();

        $user->email = 'new@email.com';
        $user->password = 'new password';
        $user->phone = '+324 new';
        $user->phone_public = '1';
        $user->first_name = 'Juzek';
        $user->last_name = 'Polanski';
        $user->last_name_public = '0';

        $id = $user->save();

        $this->assertEquals(4, $id);
    }

    public function testUpdateUser() {
        $user = new My_Houseshare_User(2);

        $user->phone_public = '0';
        $user->first_name = 'Jerzy';
        $user->last_name = 'Powanski';
        $user->last_name_public = '1';

        $id = $user->save();

        $this->assertEquals(2, $id);
    }


}

?>
