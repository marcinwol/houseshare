<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of userModelTest
 *
 * @author marcin
 */
class UserModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_User';
    /**
     * @dataProvider setUserDataProvider
     */
    public function testSetUser($data, $id, $expectedID) {
        // if $id === null than create new user, otherwise update current user
        $user_id = $this->_model->setUser($data, $id);
        $this->assertEquals($expectedID, $user_id);

        $userData = $this->_model->find($user_id)->current()->toArray();

        //var_dump($userData);

        unset($userData['user_id']);
        unset($userData['created']);
        unset($userData['is_enabled']);
        $this->assertEquals($data, $userData);
    }

    public function setUserDataProvider() {

        $argSet = array();

        $argSet[] = array(
            array(
                'email' => 'some@email.com',
                'password' => 'some_password',
                'phone' => '3423 234234',
                'phone_public' => 1,
                'first_name' => 'Marek',
                'last_name' => 'Kurzynski',
                'last_name_public' => 1,
                'type' => 'ROOMATE'
            ),
            null, // create new user
            4     // expected id of the new user
        );

        $argSet[] = array(
            array(
                'email' => 'some@email2.com',
                'password' => 'some_password2',
                'phone' => '23423 234234',
                'phone_public' => 0,
                'first_name' => 'Piotr',
                'last_name' => 'Caban',
                'last_name_public' => 0,
                'type' => 'ROOMATE'
            ),
            2, // update new user with id = 2
            2     // expected id is 2 (just update, no new user)
        );



        $userData = $this->_getUserModel()->find(3)->current()->toArray();

        unset($userData['user_id']);
        unset($userData['created']);
        unset($userData['is_enabled']);

        // change only phone info
        $userData['phone'] = 'new phone 432';
        $userData['phone_public'] = 0;

        $argSet[] = array(
            $userData,
            3, // update new user with id = 3
            3  // expected id is 3 (just update, no new user)
        );

        return $argSet;
    }

    /**
     * Gets USER model
     *
     * @return My_Model_Table_User
     */
    protected function _getUserModel() {
        $this->setUp();
        return $this->_model;
    }

    /**
     * @expectedException Zend_Db_Exception
     */
    public function testThrowExceptionEmail() {

        // email to be inserted is already in db.
        // thus throw exception.

        $data = array(
            'email' => 'test@test.com',
            'password' => 'some_password2',
            'phone' => '23423 234234',
            'phone_public' => 0,
            'first_name' => 'Piotr',
            'last_name' => 'Caban',
            'last_name_public' => 0
        );

        // create new user
        $user_id = $this->_model->setUser($data, null);
    }

    public function testGetRoomate() {

         $user = $this->_model->find(2)->current();
         $roomateRow = $user->getRoomate();
         $this->assertEquals(0,$roomateRow->is_owner);

    }

}
?>
