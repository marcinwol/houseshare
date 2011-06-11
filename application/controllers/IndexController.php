<?php

class IndexController extends Zend_Controller_Action {

    /**
     *
     * @var Zend_Cache_Core 
     */
    private $_cache;

    public function init() {

        $this->_cache = Zend_Controller_Front::getInstance()
                ->getParam('bootstrap')
                ->getResource('cachemanager')
                ->getCache('mycache');

        //  $this->_helper->cache(array('preview'), array('previewaction'));
    }

    /**
     * This is for tests, experiments, etc.
     */
    public function testAction() {

      $model = new My_Model_Table_City();
      
     // var_dump($model->fetchAll());
       
      $this->view->layout()->some_val = 100;

        var_dump($request->getUserParams());
    }

    public function indexAction() {

        Zend_Session::namespaceUnset('addAccInfo');

        $mainForm = new My_Form_MainPage();
        $page = $this->_getParam('page', 1);

        if ($this->getRequest()->isPost()) {
            if ($mainForm->isValid($_POST)) {

                // $whatToDo = $mainForm->getValue('rd_what_to_do');
                $whatToDo = '0';
                $cityName = $mainForm->getValue('i_city');
                $maxPrice = $mainForm->getValue('maxprice');
                $accType = $mainForm->getValue('acctype');

                if ('1' === $whatToDo) {
                    return $this->_redirect('/add/city/' . $cityName);
                } elseif ('0' === $whatToDo) {
                   // $url = $this->view->url(array('city' => $cityName, 'cityname'),'acclist');
                    return $this->_redirect("/list/city/$cityName/maxprice/$maxPrice");
                }
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

