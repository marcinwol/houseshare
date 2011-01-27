<?php


class My_Tools {


    static function myEscape($par) {
        $a = html_entity_decode($par);
        $a = stripslashes($a);
        return $a;
    }

}

?>
