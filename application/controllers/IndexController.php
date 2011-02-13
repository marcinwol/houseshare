<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    /**
     * This is for tests, experiments, etc.
     */
    public function testAction() {

       //  $this->view->headScript()->appendFile($this->view->baseUrl('/js/openid-en2.js'));

//        $cityModel = new My_Model_Table_City();
//        var_dump($cityModel->getCities()->toArray());
//
//        $data = array (
//            'name' => 'nevermind',
//            'state_id' => '1',
//            'created' => new Zend_Db_Expr('NOW()')
//        );
//
//        $cityModel->insert($data);
        //$myForm->addDecorator($myCustomFormDecorator);

      //  $client = new Zend_Rest_Client('http://framework.zend.com/rest');

      //   var_dump($client->sayHello('Marcin', 'Day')->get());

//        $db = Zend_Db_Table::getDefaultAdapter();
//
//        $select = $db->select();
//        $select->from('advertisercontest', '*')
//                ->joinLeft(
//                        'advertisercontest',
//                        'advertiseraccount.loginid = advertisercontest.loginid',
//                        array('advertiseraccount.advertiserid', 'advertiseraccount.companyname')
//                        )
//                ->where('advertisercontest.golive is not NULL');;
//
//        $result = $db->fetchAll($select);
//
//        var_dump($result);
        //
        $input = array(
            array(
                'firstname' => 'somename',
                'lastname' => 'somelastname',
                'location' => 'somelocation'
            ),
            array(
                'firstname' => 'somename2',
                'lastname' => 'somelastname2',
                'location' => 'somelocation2'
            )
        );

        $paginator = Zend_Paginator::factory($input);
        $paginator->setCurrentPageNumber(1);

        foreach ($paginator as $key => &$value) {

            // performe some logic to check if if the home directory has been correctly created
            // and the boolean value to represent this.

            $value['newVariable'] = false;
            var_dump($value);
        }

        $this->view->paginator = $paginator;
    }

    public function indexAction() {

        $mainForm = new My_Form_MainPage();

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

