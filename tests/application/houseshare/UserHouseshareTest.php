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
            array('My_Houseshare_Roomate'),
            array('My_Houseshare_Looker')
        );
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

        if ('My_Houseshare_Roomate' == $userClass) {
            $user->is_owner = '0';
        }

        $id = $user->save();

        $this->assertEquals(2, $id);

        if ('My_Houseshare_Roomate' == $userClass) {
            $this->assertEquals('0', $user->is_owner);
        }
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
        $user->type = 'ROOMATE';

        if ('My_Houseshare_Roomate' == $userClass) {
            $user->is_owner = '1';
        }

        $id = $user->save();

        $user = new $userClass(4);

        $this->assertEquals(
                array(
                    4,
                    'Juzek',
                    'Polanski',
                    'new@email.com',
                    '0'
                ),
                array(
                    $user->user_id,
                    $user->first_name,
                    $user->last_name,
                    $user->email,
                    $user->last_name_public
                )
        );
        
    }

    /**
     * @dataProvider userClassProvider
     */
    public function testUpdateUser1($userClass) {
        $user = new $userClass(2);

        $user->phone_public = '0';
        $user->first_name = 'Jerzy';
        $user->last_name = 'Powanski';
        $user->last_name_public = '1';

        if ('My_Houseshare_Roomate' == $userClass) {
            $user->is_owner = '0';
        }

        $id = $user->save();

        $user = new $userClass($id);

        $this->assertEquals(
                array(
                    2,
                    'Jerzy',
                    'Powanski',
                    'michal@michal.com',
                    '1'
                ),
                array(
                    $user->user_id,
                    $user->first_name,
                    $user->last_name,
                    $user->email,
                    $user->last_name_public
                )
        );

        if ('My_Houseshare_Roomate' == $userClass) {
            $this->assertEquals('0', $user->is_owner);
        }
    }

    /**
     * @expectedException Zend_Db_Exception
     * @dataProvider userClassProvider
     */
    public function testNoUserException($userClass) {
        $user = new $userClass(15);
    }

    /**
     * @dataProvider userClassProvider
     */
    public function testGetAccommodations($userClass) {

        if ('My_Houseshare_Roomate' === $userClass) {
            $user = new $userClass(1);
            $expectedNoOfAcc = 2;
        } else {
            $user = new $userClass(3);
            $expectedNoOfAcc = 0;
        }

        $acc = $user->getAccommodations();
        $this->assertEquals($expectedNoOfAcc, count($acc));
    }

}

?>
