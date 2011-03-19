<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tip
 *
 * @author marcin
 */
class My_Form_Decorator_Jtip extends Zend_Form_Decorator_Abstract {
   
    
    
    /**
     * Inserts jtip just before end of element (i.e. </dd> tag)
     * 
     * @param string $content
     * @return string 
     */
    public function render($content)  {               
        $tipurl  = $this->getOption('tipurl');        
        $tipname = $this->getOption('tipname')?  $this->getOption('tipname'): '';
        $tipurl  = $this->_getBaseUrl() . $tipurl;
        
        $html = '<span class="formInfo">
                   <a href="'.$tipurl.'" class="jTip" id="two" name="'.$tipname.'">?</a>
               </span>';                 
        $ddEndTagPos = strpos($content, '</dd>');
        return str_replace('</dd>', $html . '</dd>', $content);       
    }
    
    /**
     * Gets baseUrl
     * 
     * @return string 
     */
    protected function _getBaseUrl() {        
        return  Zend_Layout::getMvcInstance()->getView()->baseUrl();
    }
    
}

?>
