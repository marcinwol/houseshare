<?php

class IndexController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    /**
     * This is for tests, experiments, etc.
     */
    public function testAction() {


        $form = new Zend_Form;

        $form->removeDecorator('htmlTag');

        $form->setAction('/index/login')
                ->setMethod('post')
                ->setAttrib('id', 'login_form');

        $username = $form->createElement('text', 'username');

        $username->addValidator('alnum')
                ->setRequired(TRUE)
                ->setLabel('Username')
                ->setAttrib('class', 'login_input');


        // anonymouse function that will generate your image tage
        $makeImg = function($content, $element, array $options) {
                    return '<img src="/images/' . $options['img'] . '" class="' . $options['class'] . ' " alt=""/> ';
                };


        $username->setDecorators(array(
            'ViewHelper',
            'Errors',
            array('Label', array('class' => 'login_label')),
            array('Callback',
                array(
                    'callback' => $makeImg,
                    'img' => 'user_icon.png',
                    'class' => 'login_icon',                    
                    'placement' => 'PREPEND'
                )
            ),
            array('HtmlTag', array('tag' => 'div', 'class' => 'input_row')),
        ));
               
                

        $form->addElement($username);


        $submit = $form->createElement('submit', 'login', array(
                    'label' => 'Login',
                    'class' => 'login_submit'
                        )
        );


        $submit->setDecorators(array(
            'ViewHelper',
            'Errors',
            array('HtmlTag', array('tag' => 'div', 'class' => 'input_row')),
        ));

        $form->addElement($submit);
//       


        $this->view->form = $form;
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

