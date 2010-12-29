<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    public function indexAction() {

        $mainForm = new My_Form_MainPage();

        if ($this->getRequest()->isPost()) {
            if ($mainForm->isValid($_POST)) {

                $whatToDo = $mainForm->getValue('rd_what_to_do');
                $cityName = $mainForm->getValue('i_city');

                if ('1' === $whatToDo) {
                    return $this->_redirect('/accommodation/add/city/' . $cityName);
                } elseif ('0' === $whatToDo) {
                    return $this->_redirect('/accommodation/list/city/' . $cityName);
                }
            }
        }

        $mainForm->setAction($this->view->baseUrl() . '/index/index');
        $this->view->mainForm = $mainForm;
    }

    public function getcitiesAction() {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $term = $this->getRequest()->getParam('term');
            $nostate = $this->getRequest()->getParam('nostate', 0);
            $cityModel = new My_Model_DbView_City();

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
            $stateModel = new My_Model_DbTable_State();

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


}

