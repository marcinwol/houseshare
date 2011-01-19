<?php

/**
 * Description of AccsFeaturesModelTest
 *
 * @author marcin
 */
class AccsFeaturesModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_AccsFeatures';

    public function testGetAll() {
        $rows = $this->_model->fetchAll();
        $this->assertEquals(count($rows), 8);
    }

    /**
     * @dataProvider getNameAndValueProvider
     */
    public function testGetNameAndValue($id, $expected) {
        $row = $this->_model->find($id[0], $id[1])->current();
        $this->assertEquals(
                array(
                    $expected['name'],
                    $expected['value']
                ),
                array(
                    $row->getName(),
                    $row->getValue()
                )
        );
    }

    public function getNameAndValueProvider() {
        return array(
            array(array(1, 1), array('name' => 'internet', 'value' => 0)),
            array(array(2, 3), array('name' => 'tv', 'value' => 1)),
        );
    }

    /**
     * @dataProvider getSetAccFeatureProvider
     */
    public function testSetAccFeature($id, $data) {
        $result_id = $this->_model->setAccFeature($data, $id);

        $new_row = $this->_model->find(
                        $result_id['acc_id'], $result_id['feat_id'])->current();

        $this->assertEquals(
                array(
                    $id['acc_id'],
                    $id['feat_id'],
                    $new_row->getValue()
                ),
                array(
                    $result_id['acc_id'],
                    $result_id['feat_id'],
                    $data['value']
                )
        );
    }

    public function getSetAccFeatureProvider() {
        return array(
            array(array('acc_id' => 1, 'feat_id' => 1), array('value' => 1)),
            array(array('acc_id' => 1, 'feat_id' => 5), array('value' => 1)),
            array(array('acc_id' => 2, 'feat_id' => 3), array('value' => 1)),
            array(array('acc_id' => 3, 'feat_id' => 3), array('value' => 0)),
        );
    }

    /**
     * Throw exception due to referential integrity violation, i.e.
     * no such accommodation, no such feature
     *
     * @expectedException Zend_Db_Statement_Exception
     * @dataProvider getSetAccFeatureExceptionProvider
     */
    public function testSetAccFeatureException($id, $data) {
        $result_id = $this->_model->setAccFeature($data, $id);
    }

    public function getSetAccFeatureExceptionProvider() {
        return array(
            array(array('acc_id' => 0, 'feat_id' => 1), array('value' => 1)),
            array(array('acc_id' => 1, 'feat_id' => 0), array('value' => 1)),
            array(array('acc_id' => 5, 'feat_id' => 9), array('value' => 1))
        );
    }


     /**
     *
     * @dataProvider deleteAccFeatureProvider
     */
    public function testDeleteAccFeature($id, $expected_count) {
        $result = $this->_model->deleteAccFeature($id);
        $this->assertEquals($expected_count, $result);
    }

    public function deleteAccFeatureProvider() {
        return array(
            array(array('acc_id' => 1, 'feat_id' => 1), 1),
            array(array('acc_id' => 1, 'feat_id' => 2), 1),
            array(array('acc_id' => 2, 'feat_id' => 3), 1),
            array(array('acc_id' => 2, 'feat_id' => 5), 0)
        );
    }


}

?>
