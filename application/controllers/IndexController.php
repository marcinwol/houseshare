<?php

class IndexController extends Zend_Controller_Action {

    public function init()    {
        /* Initialize action controller here */
    }

    public function indexAction()  {
        
       
        $mainForm = new My_Form_MainPage();

        // get all cities
        $avaliableCities = My_Model_DbTable_City::getAllCities()->toArray();
        $mainForm->setCitySelect($avaliableCities);
        
        if ($this->getRequest()->isPost()) {           
            if ($mainForm->isValid($_POST)) {

                $whatToDo = $mainForm->getValue('rd_what_to_do');
                $cityID = $mainForm->getValue('s_city');

                if ('1' === $whatToDo ) {
                    return $this->_redirect('/accommodation/add/city_id/' . $cityID);                    
                } elseif ('0' === $whatToDo ) {
                    return $this->_redirect('/accommodation/list/city_id/' . $cityID);                    
                }                
            }
        }
       
        $mainForm->setAction($this->view->baseUrl() . '/index/index');
        $this->view->mainForm = $mainForm;
    
    }


}

