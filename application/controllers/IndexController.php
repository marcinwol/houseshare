<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    /**
     * This is for tests, experiments, etc.
     */
    public function testAction() {

        $db = Zend_Db_Table::getDefaultAdapter();

        //  $innerSelect = $db->select('em.firstnm')->from('tbl_employeemaster em')->where('em.idemp = empl.approvedby');
        //  $select = $db->select()->from(tbl_empleaveapplication empl)
//        var_dump(get_class($this->view->layout()));
//        $this->view->layout()->setContentKey('rightColumn');
//        
    }

    public function indexAction() {

        $mainForm = new My_Form_MainPage();
        $page = $this->_getParam('page', 1);

        if ($this->getRequest()->isPost()) {
            if ($mainForm->isValid($_POST)) {

                // $whatToDo = $mainForm->getValue('rd_what_to_do');
                $whatToDo = '0';
                $cityName = $mainForm->getValue('i_city');
                $maxPrice = $mainForm->getValue('maxprice');

                if ('1' === $whatToDo) {
                    return $this->_redirect('/add/city/' . $cityName);
                } elseif ('0' === $whatToDo) {
                    return $this->_redirect("/list/city/$cityName/maxprice/$maxPrice");
                }
            }
        }

        $this->view->page = $page;
        $this->view->mainForm = $mainForm;
    }

    public function getcitiesAction() {

        if ($this->getRequest()->isXmlHttpRequest()) {

            $term = $this->getRequest()->getParam('term');
            $nostate = $this->getRequest()->getParam('nostate', 0);

            $cityModel = new My_Model_View_City();
            //$cities = $cityModel->findCitiesBasedOnName($term, 5)->toArray();
            $cities = $cityModel->fetchAll()->toArray();

            $matches = array();
            foreach ($cities as $city) {

                if (1 == $nostate) {
                    $label = $value = $city['city_name'];
                } else {
                    $label = $value = "{$city['city_name']}, {$city['state_name']}";
                }
                $value = $city['city_name'];
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

        if ($this->getRequest()->isXmlHttpRequest()) {

            $term = $this->getRequest()->getParam('term');
            $streetModel = new My_Model_Table_Street();

            //$streets = $streetModel->findBasedOnName($term, 5)->toArray();
            $streets = $streetModel->fetchAll()->toArray();

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

