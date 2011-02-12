<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Form
 *
 * @author marcin
 */
class My_View_Helper_CustomForm extends Zend_View_Helper_Form {


     /**
     * Render HTML form
     *
     * @param  string $name Form name
     * @param  null|array $attribs HTML form attributes
     * @param  false|string $content Form content
     * @return string
     */
    public function customForm($name, $attribs = null, $content = false)
    {
  
        // get myText and unset it from $attribs afterwards.
        $myText = '';        
        if (array_key_exists('myText', $attribs)) {
            $myText = $attribs['myText'];
            unset($attribs['myText']);
        }

        $info = $this->_getInfo($name, $content, $attribs);
        extract($info);

        if (!empty($id)) {
            $id = ' id="' . $this->view->escape($id) . '"';
        } else {
            $id = '';
        }

        if (array_key_exists('id', $attribs) && empty($attribs['id'])) {
            unset($attribs['id']);
        }

        $xhtml = '<form'
               . $id
               . $this->_htmlAttribs($attribs)
               . '>';

        // THE FOLLOWING LINE IS THE NEW STUFF.
        // THE REST IS FROM Zend_View_Helper_Form.
        // WE PUT $myText after opening <form> tag.
        // THIS IS WHERE $myText GOES.
        $xhtml .= $myText . 'sadfsf';


        // the rest of the form, as usuall.
        if (false !== $content) {
            $xhtml .= $content
                   .  '</form>';
        }

        return $xhtml;
    }

}
?>
