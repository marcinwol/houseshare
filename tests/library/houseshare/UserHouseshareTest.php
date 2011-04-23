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
                ), array(
            $user->first_name,
            $user->last_name
                )
        );

        $user = new $userClass(2);
        $this->assertEquals(
                array(
            'Michal',
            'Chojcan'
                ), array(
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
        $user->email_public =  '1';
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
                ), array(
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
                ), array(
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
     * 
     * @dataProvider userClassProvider
     */
    public function testGetUserPassword($userClass) {
        $user = new $userClass(1);
        $this->assertEquals('60474c9c10d7142b7508ce7a50acf414', $user->password);

        $user = new $userClass(2);
        $this->assertEquals('some_pass2', $user->password);
    }

    /**
     * 
     * @dataProvider userClassProvider
     */
    public function testSetUserPassword($userClass) {
        $user = new $userClass(2);
        $user->password = 'newPassword';    // md5 is 14a88b9d2f52c55b5fbcf9c5d9c11875  
        $user->save();
        unset($user);

        $user = new $userClass(2);
        $this->assertEquals('14a88b9d2f52c55b5fbcf9c5d9c11875', $user->password);
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
            $expectedNoOfAcc = 3;
        } else {
            $user = new $userClass(3);
            $expectedNoOfAcc = 0;
        }

        $acc = $user->getAccommodations();
        $this->assertEquals($expectedNoOfAcc, count($acc));
    }

    public function testUserFactory() {

        // no user with acc_id = 12
        $user = My_Houseshare_Factory::user(12);
        $this->assertTrue(null === $user);

        // get Shared object since user_id=1 is shared.
        $user = My_Houseshare_Factory::user(1);
        $this->assertTrue($user instanceof My_Houseshare_Roomate);

        // get Shared object since user_id=2 is shared.
        $user = My_Houseshare_Factory::user(2);
        $this->assertTrue($user instanceof My_Houseshare_Roomate);


        // get roomate object since user_id=2 is shared.
        $user = My_Houseshare_Factory::roomate(2);
        $this->assertTrue($user instanceof My_Houseshare_Roomate);

        // get new roomate object .
        $user = My_Houseshare_Factory::roomate();
        $this->assertTrue($user instanceof My_Houseshare_Roomate);

        // get new user object .
        $user = My_Houseshare_Factory::user();
        $this->assertTrue($user instanceof My_Houseshare_User);

        // get new user object .
        $user = My_Houseshare_Factory::user(null, 'USER');
        $this->assertTrue($user instanceof My_Houseshare_User);

        // get new user object .
        $user = My_Houseshare_Factory::user(null, 'ROOMATE');
        $this->assertTrue($user instanceof My_Houseshare_Roomate);
    }

}

?>
