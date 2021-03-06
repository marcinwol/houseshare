<?php

class IndexController extends Zend_Controller_Action {

    /**
     * This is for tests, experiments, etc.
     */
    public function testAction() {

      $db = Zend_Db_Table::getDefaultAdapter();
      
      $select = $db->select();
      
      $select->from('table_name')
              ->order(new Zend_Db_Expr("FIELD(field_name, 'Small','Medium','Large')"));
              
    
      var_dump($select->assemble());
      exit;
       
       
    }

    public function indexAction() {

        Zend_Session::namespaceUnset('addAccInfo');

        $mainForm = new My_Form_MainPage();
        $page = $this->_getParam('page', 1);

        // $mainForm->getElement('i_city')->markAsError();

        if ($this->getRequest()->isPost()) {
            if ($mainForm->isValid($_POST)) {

                // $whatToDo = $mainForm->getValue('rd_what_to_do');
                $whatToDo = '0';
                $cityID = $mainForm->getValue('i_city');
                $maxPrice = $mainForm->getValue('maxprice');
                $accType = $mainForm->getValue('acctype');

                // get the name of a city for a given cityID
                $cityModel = new My_Model_Table_City();
                $cityRow = $cityModel->find($cityID)->current();

                // construct url parameters for the route
                $urlParams = array('city' => $cityID, 'cityname' => $cityRow->name, 'maxprice' => $maxPrice);

                return $this->_helper->redirector->gotoRoute($urlParams, 'listacc');
            }
        }

        $this->view->page = $page;
        $this->view->mainForm = $mainForm;
    }

    public function getcitiesAction() {

        $autocompleterCache = Zend_Controller_Front::getInstance()
                ->getParam('bootstrap')
                ->getResource('cachemanager')
                ->getCache('autocompleter');


        if ($this->getRequest()->isXmlHttpRequest()) {

            $term = $this->getRequest()->getParam('term');
            $nostate = $this->getRequest()->getParam('nostate', 0);

            $cacheId = 'cities_' . md5($term);
            $matches = $autocompleterCache->load($cacheId);

            if (!$matches) {
                $cityModel = new My_Model_View_City();
                $cities = $cityModel->findCitiesBasedOnName($term, 5)->toArray();

                $matches = array();
                foreach ($cities as $city) {

                    if (1 == $nostate) {
                        $label = $value = ($city['city_name']);
                    } else {
                        $label = $value = "{$city['city_name']}, {$city['state_name']}";
                    }
                    $value = $city['city_name'];
                    $city['value'] = ($value);
                    $city['label'] = ($label);
                    $city['city_id'] = $city['city_id'];
                    $city['state'] = ($city['state_name']);
                    $matches [] = $city;
                }

                $autocompleterCache->save($matches, $cacheId);
            }


            $this->_helper->json($matches);
        } else {
            throw new Exception('Not an ajax requrests');
        }
    }

    public function getstatesAction() {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $term = $this->getRequest()->getParam('term');
            $matches = array();

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

        $autocompleterCache = Zend_Controller_Front::getInstance()
                ->getParam('bootstrap')
                ->getResource('cachemanager')
                ->getCache('autocompleter');


        if ($this->getRequest()->isXmlHttpRequest()) {

            $term = $this->getRequest()->getParam('term');

            //  $t1 = microtime(true);
            $cacheId = 'streets_' . md5($term);
            $matches = $autocompleterCache->load($cacheId);

            if (!$matches) {
                $streetModel = new My_Model_Table_Street();
                $streets = $streetModel->findBasedOnName($term, 10)->toArray();

                $matches = array();
                foreach ($streets as $street) {

                    $street['value'] = ($street['name']);
                    $street['label'] = $street['value'];
                    $matches[] = $street;
                }

                $autocompleterCache->save($matches, $cacheId);
            }

            $this->_helper->json($matches);
        } else {
            throw new Exception('Not an ajax requrests');
        }
    }

    public function getRecentAdvertsAction() {
        if ($this->getRequest()->isXmlHttpRequest()) {
            $this->_helper->layout->disableLayout();

            $page = $this->getRequest()->getParam('page', 1);
            $this->page = $page;
        }
    }

}

