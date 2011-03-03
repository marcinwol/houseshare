<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    /**
     * This is for tests, experiments, etc.
     */
    public function testAction() {


        //$client = new Zend_Http_Client('http://www.example.com', array('adapter'=>'Zend_Http_Client_Adapter_Curl'));
//
////
//        $streetModel = new My_Model_Table_Street();
//        $newRow = $streetModel->createRow(array('name'=> 'sdfasfd'));
//
//        $newRow->save();
//        return;

//        $model = new My_Model_Table_State();
//        $select = $model->select();
//        $select->setIntegrityCheck(false);
//        $select->from('STATE');
//        $select->where('LENGTH(image) > 0');
//
//        $result = $model->fetchAll($select);
//
//        var_dump($result->toArray());
        // action body
        $this->view->echo_in_view = "HERE";
        echo "INSIDE ACTION";
        var_dump(get_class($this));
    }

    public function indexAction() {

//        $options = $this->getInvokeArg('bootstrap')->getOption('mytranslator');
//        var_dump($options);
//
//        'content' => array(
//                "emailNotUnique" => 'Your user already exists' ,
//                "Value is required and can't be empty" => 'You must specify your ID'
//        );

        $mainForm = new My_Form_MainPage();
        // $mainForm->addDecorator(array('div' => 'HtmlTag'), array('tag' => 'div'));
        // $mainForm->addDecorator(array('li' => 'HtmlTag'), array('tag' => 'li', 'class' => 'af_title'));
        //  $mainForm->addDecorator('Label', array('tag' => 'td'));
        // $mainForm->setTranslator(new Zend_Translate($options));

        if ($this->getRequest()->isPost()) {
            if ($mainForm->isValid($_POST)) {
                  
                $whatToDo = $mainForm->getValue('rd_what_to_do');
                $cityName = $mainForm->getValue('i_city');

                if ('1' === $whatToDo) {
                    return $this->_redirect('/add/city/' . $cityName);
                } elseif ('0' === $whatToDo) {
                    return $this->_redirect('/list/city/' . $cityName);
                }
            }
        }

        $this->view->mainForm = $mainForm;
    }

    public function getcitiesAction() {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $term = $this->getRequest()->getParam('term');
            $nostate = $this->getRequest()->getParam('nostate', 0);
            $cityModel = new My_Model_View_City();

            $cities = $cityModel->findCitiesBasedOnName($term, 5)->toArray();

            $matches = array();
            foreach ($cities as $city) {

                if (1 == $nostate) {
                    $label = $value = $city['city_name'];
                } else {
                    $label = $value = "{$city['city_name']}, {$city['state_name']}";
                }
                $city['value'] = $value;
                $city['label'] = $label;
                $city['city_id'] = $city['city_id'];
                $city['state'] = $city['state_name'];
                $matches[] = $city;
            }

            $this->_helper->json($matches);
        } else {
            throw new Exception('Not an ajax requrests');
        }
    }

    public function getstatesAction() {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $term = $this->getRequest()->getParam('term');
            $stateModel = new My_Model_Table_State();

            $states = $stateModel->findStatesBasedOnName($term, 5)->toArray();

            $matches = array();
            foreach ($states as $state) {

                $city['value'] = $state['name'];
                $city['label'] = $state['name'];
                $matches[] = $city;
            }

            $this->_helper->json($matches);
        } else {
            throw new Exception('Not an ajax requrests');
        }
    }

    public function getstreetsAction() {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $term = $this->getRequest()->getParam('term');
            $streetModel = new My_Model_Table_Street();

            $streets = $streetModel->findBasedOnName($term, 5)->toArray();

            $matches = array();
            foreach ($streets as $street) {

                $street['value'] = $street['name'];
                $street['label'] = $street['name'];
                $matches[] = $street;
            }

            $this->_helper->json($matches);
        } else {
            throw new Exception('Not an ajax requrests');
        }
    }

}

