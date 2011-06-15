<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Truncate
 *
 * @link http://www.virgentech.com/blog/2009/06/truncate-view-helper-for-zend-framework.html
 */
class My_View_Helper_Truncate extends Zend_View_Helper_Abstract {

    public function truncate($string, $start = 0, $length = 50, $prefix = '...', $postfix = '...') {


        // return $this->_limitString($string, $length);
        $truncated = trim($string);
        $start = (int) $start;
        $length = (int) $length;

        // Return original string if max length is 0
        if ($length < 1)
            return $truncated;

        $full_length = iconv_strlen($truncated);

        // Truncate if necessary
        if ($full_length > $length) {
            // Right-clipped
            if ($length + $start > $full_length) {
                $start = $full_length - $length;
                $postfix = '';
            }

            // Left-clipped
            if ($start == 0)
                $prefix = '';

            // Do truncate!
            $truncated = $prefix . trim(substr($truncated, $start, $length)) . $postfix;
        }

        return ucfirst(strtolower($truncated));
    }

    

}

?>
