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

    public function userClassProvider() {
        return array(
            array('My_Houseshare_User'),
            array('My_Houseshare_Roomate')
        );
    }

    /**
     * @dataProvider userClassProvider
     */
    public function testGetUser($userClass) {
        $user = new $userClass(1);

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

        $user = new $userClass(2);
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

    /**
     * @dataProvider userClassProvider
     */
    public function testInsertUser($userClass) {
        $user = new $userClass();

        $user->email = 'new@email.com';
        $user->password = 'new password';
        $user->phone = '+324 new';
        $user->phone_public = '1';
        $user->first_name = 'Juzek';
        $user->last_name = 'Polanski';
        $user->last_name_public = '0';

        if ( 'My_Houseshare_Roomate' == $userClass) {
            $user->is_owner = '1';
        }

        $id = $user->save();

        $this->assertEquals(4, $id);
    }

    /**
     * @dataProvider userClassProvider
     */
    public function testUpdateUser($userClass) {
        $user = new $userClass(2);

        $user->phone_public = '0';
        $user->first_name = 'Jerzy';
        $user->last_name = 'Powanski';
        $user->last_name_public = '1';

        if ( 'My_Houseshare_Roomate' == $userClass) {
            $user->is_owner = '0';
        }

        $id = $user->save();

        $this->assertEquals(2, $id);

         if ( 'My_Houseshare_Roomate' == $userClass) {
            $this->assertEquals('0', $user->is_owner);
        }
    }

}

?>
