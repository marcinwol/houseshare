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
            $cityModel = new My_Model_DbView_City();
            
            $cities = $cityModel->findCitiesBasedOnName($term,5)->toArray();

            $matches = array();
            foreach ($cities as $city) {
                 $city['value'] = "{$city['city_name']}, {$city['state_name']}";
                 $city['label'] = "{$city['city_name']}, {$city['state_name']}";
                 $city['city_id'] = $city['city_id'];
                 $matches[] = $city;
            }

             $this->_helper->json($matches);

        } else {
            throw new Exception('Not an ajax requrests');
        }
    }

}

