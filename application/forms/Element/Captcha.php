<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 * @version    $Id: Captcha.php 22328 2010-05-30 15:09:06Z bittarman $
 */

/** @see Zend_Form_Element_Xhtml */
require_once 'Zend/Form/Element/Xhtml.php';

/** @see Zend_Captcha_Adapter */
require_once 'Zend/Captcha/Adapter.php';

/**
 * Generic captcha element
 *
 * This element allows to insert CAPTCHA into the form in order
 * to validate that human is submitting the form. The actual
 * logic is contained in the captcha adapter.
 *
 * @see http://en.wikipedia.org/wiki/Captcha
 *
 * @category   Zend
 * @package    Zend_Form
 * @subpackage Element
 * @copyright  Copyright (c) 2005-2010 Zend Technologies USA Inc. (http://www.zend.com)
 * @license    http://framework.zend.com/license/new-bsd     New BSD License
 */
class My_Form_Element_Captcha extends Zend_Form_Element_Captcha
{

    /**
     * My render form element
     *
     * @param  Zend_View_Interface $view
     * @return string
     */
    public function render(Zend_View_Interface $view = null)
    {
        $captcha    = $this->getCaptcha();
        $captcha->setName($this->getFullyQualifiedName());

        $decorators = $this->getDecorators();

        $decorator = new My_Form_Decorator_Captcha(array('captcha' => $captcha));
        array_unshift($decorators, $decorator);

        $decorator  = $captcha->getDecorator();
        
        $this->setDecorators($decorators);
  

        $this->setValue($this->getCaptcha()->generate());
     
        return Zend_Form_Element::render($view);
    }




}
