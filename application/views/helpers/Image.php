<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Image
 *
 * @author marcin
 */
class My_View_Helper_Image extends Zend_View_Helper_Abstract {

    protected static $_cache = null;

    public function image() {
        require_once '/opt/lampp/lib/php/WideImage/WideImage.php';
        
        $image = WideImage::load(
             realpath(APPLICATION_PATH . '/../tests/application/_files/test.jpg')
        );

      //  return 'sadf';


           $resized = $image->resize(400, 300);
        //automatically sets content headers within wi class
         //  $out = '"Content-type: image/jpeg; charset=iso-8859-1\n\n';
         //  $out .= $resized->asString('jpg', 90);
         //  return $out;
         //header('"Content-Type: image/jpeg; charset=iso-8859-1');
         ///return $resized->asString('jpg', 90);
       //  ob_clean();
            $resized->output('jpg', 90);
            
    //       return $out;
    }

}

?>
