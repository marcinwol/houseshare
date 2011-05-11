<?php
class My_Form_InventoryForm extends Zend_Form
{   
    private $from;
    private $to;
    private $noOfRooms;
    private $roomtype;

    private $cancel;
    private $save;


    function init()
    {
        $this->setName("frmAddInventory");
        $attribs = array(
            "id" => "frmAddInventory",
            "name" => "frmAddInventory"
        );

        $this->setAttribs($attribs);


        $this->from = new Zend_Form_Element_Text("invDateFrom");
        $this->from->setLabel("From");
        $this->from->setDecorators(
                             array(
                                  array('ViewHelper',
                                            array('helper' => 'formText')
                                ),
                                array('HtmlTag',
                                            array('tag' => 'div', 'class' => 'formfield clearfix')
                                ),
                                array('Label',
                                            array('class' => 'label')
                                ),
                             )
                         );                             

        $this->to = new Zend_Form_Element_Text("invDateTo");
        $this->to->setLabel("To");
        $this->to->setDecorators(
                                 array(
                                      array('ViewHelper',
                                                array('helper' => 'formText')
                                    ),
                                    array('HtmlTag',
                                                array('tag' => 'div', 'class' => 'formfield clearfix')
                                    ),
                                    array('Label',
                                                array('class' => 'label')
                                    ),
                                 )
                             );

        $this->noOfRooms = new Zend_Form_Element_Text("invNoOfRooms");
        $this->noOfRooms->setLabel("Rooms");
        $this->noOfRooms->setDecorators(
                                         array(
                                              array('ViewHelper',
                                                        array('helper' => 'formText')
                                            ),
                                            array('HtmlTag',
                                                        array('tag' => 'div', 'class' => 'formfield clearfix')
                                            ),
                                            array('Label',
                                                        array('class' => 'label')
                                            ),
                                         )
                                     );

        $this->roomtype = new Zend_Form_Element_Hidden("hdnRoomType");      

        $this->save = new Zend_Form_Element_Button("btnSave","Save");

        $this->cancel = new Zend_Form_Element_Reset("btnReset","Cancel");


        $elements = array(
            $this->noOfRooms,
            $this->from,
            $this->to,
            $this->roomtype,
            $this->save,
            $this->cancel
        );

        $this->addElements($elements);
    }




}