<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhotoModelTest
 *
 * @author marcin
 */
class ViewCounterModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_ViewCounter';

    public function testGetAll() {
        $result = $this->_model->fetchAll();
        $this->assertEquals(5, count($result));
    }

    public function testInsertViewWithDuplicates() {

        $allowDuplicates = true;

        // insert first
        $id = $this->_model->insertView(array(
                    'remote_ip' => '127.0.0.1',
                    'acc_id' => 3
                        ), $allowDuplicates);

        $this->assertEquals(6, $id);

        // check if count for a given acc_id is OK
        $views = $this->_model->findViews(3);
        $this->assertEquals(1, count($views));


        // insert second 
        $id = $this->_model->insertView(array(
                    'remote_ip' => '127.0.0.1',
                    'acc_id' => 3
                        ), $allowDuplicates);

        $this->assertEquals(7, $id);

        // check if count for a given acc_id is OK
        $views = $this->_model->findViews(3);
        $this->assertEquals(2, count($views));


        // insert second 
        $id = $this->_model->insertView(array(
                    'remote_ip' => '127.0.0.1',
                    'acc_id' => 1
                        ), $allowDuplicates);

        $this->assertEquals(8, $id);

        // check if count for a given acc_id is OK
        $views = $this->_model->findViews(1);
        $this->assertEquals(4, count($views));
    }

    public function testInsertViewWithoutDuplicates() {

        $allowDuplicates = false;

        // insert first
        $id = $this->_model->insertView(array(
                    'remote_ip' => '127.0.0.1',
                    'acc_id' => 3
                        ), $allowDuplicates);

        $this->assertEquals(6, $id);

        // check if count for a given acc_id is OK
        $views = $this->_model->findViews(3);
        $this->assertEquals(1, count($views));


        // insert second 
        $id = $this->_model->insertView(array(
                    'remote_ip' => '127.0.0.1',
                    'acc_id' => 3
                        ), $allowDuplicates);

        $this->assertEquals(null, $id);

        // check if count for a given acc_id is OK
        $views = $this->_model->findViews(3);
        $this->assertEquals(1, count($views));
        
        
         // insert second 
        $id = $this->_model->insertView(array(
                    'remote_ip' => '127.0.0.1',
                    'acc_id' => 1
                        ), $allowDuplicates);

        $this->assertEquals(7, $id);

        // check if count for a given acc_id is OK
        $views = $this->_model->findViews(1);
        $this->assertEquals(4, count($views));
        
    }

}

?>
