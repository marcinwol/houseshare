<?php

/**
 * Description of AccsPreferencesModelTest
 *
 * @author marcin
 */
class AccsPreferencesModelTest extends ModelTestCase {

    protected $_modelName = 'My_Model_Table_AccsPreferences';

    public function testGetAll() {
        $rows = $this->_model->fetchAll();
        $this->assertEquals(count($rows), 6);
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
            array(array(1, 1), array('name' => 'smokers', 'value' => 0)),
            array(array(1, 3), array('name' => 'couples', 'value' => 1)),
        );
    }

    /**
     * @dataProvider getSetAccPreferenceProvider
     */
    public function testSetAccPreference($id, $data) {
        $result_id = $this->_model->setAccPreference($data, $id);

        $new_row = $this->_model->find(
                        $result_id['acc_id'], $result_id['pref_id'])->current();

        $this->assertEquals(
                array(
                    $id['acc_id'],
                    $id['pref_id'],
                    $new_row->getValue()
                ),
                array(
                    $result_id['acc_id'],
                    $result_id['pref_id'],
                    $data['value']
                )
        );
    }

    public function getSetAccPreferenceProvider() {
        return array(
            array(array('acc_id' => 1, 'pref_id' => 1), array('value' => 1)),
            array(array('acc_id' => 1, 'pref_id' => 5), array('value' => 1)),
            array(array('acc_id' => 2, 'pref_id' => 3), array('value' => 1)),
            array(array('acc_id' => 3, 'pref_id' => 3), array('value' => 0)),
        );
    }

    /**
     * Throw exception due to referential integrity violation, i.e.
     * no such accommodation, no such preference
     *
     * @expectedException Zend_Db_Statement_Exception
     * @dataProvider getSetAccPreferenceExceptionProvider
     */
    public function testSetAccPreferenceException($id, $data) {
        $result_id = $this->_model->setAccPreference($data, $id);
    }

    public function getSetAccPreferenceExceptionProvider() {
        return array(
            array(array('acc_id' => 0, 'pref_id' => 1), array('value' => 1)),
            array(array('acc_id' => 1, 'pref_id' => 0), array('value' => 1)),
            array(array('acc_id' => 2, 'pref_id' => 8), array('value' => 1)),
            array(array('acc_id' => 8, 'pref_id' => 5), array('value' => 1))
        );
    }

    /**
     *
     * @dataProvider deleteAccPreferenceProvider
     */
    public function testDeleteAccPreference($id, $expected_count) {
        $result = $this->_model->deleteAccPreference($id);
        $this->assertEquals($expected_count, $result);
    }

    public function deleteAccPreferenceProvider() {
        return array(
            array(array('acc_id' => 1, 'pref_id' => 1), 1),
            array(array('acc_id' => 1, 'pref_id' => 2), 1),
            array(array('acc_id' => 2, 'pref_id' => 3), 1),
            array(array('acc_id' => 2, 'pref_id' => 5), 1),
            array(array('acc_id' => 3, 'pref_id' => 5), 0)
        );
    }

}

?>
