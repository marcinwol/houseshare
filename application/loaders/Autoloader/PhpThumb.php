<?php
/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of PhpThumb
 *
 * @author marcin
 */
class My_Loader_Autoloader_PhpThumb implements Zend_Loader_Autoloader_Interface {

   static protected $php_thumb_classes = array(
      'PhpThumb'        => 'PhpThumb.inc.php',
      'ThumbBase'       => 'ThumbBase.inc.php',
      'PhpThumbFactory' => 'ThumbLib.inc.php',
      'GdThumb'         => 'GdThumb.inc.php',
      'GdReflectionLib' => 'thumb_plugins/gd_reflection.inc.php',
   );

  /**
   * Autoload a class
   *
   * @param   string $class
   * @return  mixed
   *          False [if unable to load $class]
   *          get_class($class) [if $class is successfully loaded]
   */
   public function autoload($class) {
      $file = APPLICATION_PATH . '/../library/PhpThumb/' . self::$php_thumb_classes[$class];
      if (is_file($file)) {
         require_once($file);
         return $class;
      }
      return false;
   }
}