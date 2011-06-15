<?php

/**
 * Given a time, it gives you the time since then in a friendly format.
 *
 * @package
 * @category
 * @author      Dave Marshall
 * @author      $Author: $
 * @version     $Rev: $
 * @since       $Date: $
 * @link        $URL: $
 */
class My_View_Helper_TimeSince  extends Zend_View_Helper_Abstract {
    
    public function timeSince($unixtime, $accuracy = 2, $splitter = ', ')  {
    if (time() > $unixtime)
    {
      $unixtime = time() - $unixtime;
    }
    else
    {
      $unixtime = $unixtime - time();
    }

    $mt = new Zend_Measure_Time($unixtime);
    $units = $mt->getConversionList();

    $tr = Zend_Registry::get('Zend_Translate');

    $chunks = array(
      Zend_Measure_Time::YEAR,
      Zend_Measure_Time::WEEK,
      Zend_Measure_Time::DAY,
      Zend_Measure_Time::HOUR,
      Zend_Measure_Time::MINUTE,
      Zend_Measure_Time::SECOND
    );

    $translations = array(
      'year' => array($tr->_('year'), $tr->_('years')),
      'week' => array($tr->_('week'), $tr->_('weeks')),
      'day' => array($tr->_('day'), $tr->_('days')),
      'h' => array($tr->_('hour'), $tr->_('hours')),
      'min' => array($tr->_('minute'), $tr->_('minutes')),
      's' => array($tr->_('second'), $tr->_('seconds'))
    );

    $measure = array();

    for($i=0; $i < count($chunks); $i++)
    {
      $chunk_seconds = $units[$chunks[$i]][0];

      if ($unixtime >= $chunk_seconds)
      {
        $measure[$units[$chunks[$i]][1]] = floor($unixtime / $chunk_seconds);
        $unixtime %= $chunk_seconds;
      }
    }
    
    $measure = array_slice($measure, 0, $accuracy, true);
    
    $str = '';
    foreach($measure as $key => $val)
    {
      $unit = $translations[$key];

      if($val == 1)
      {
        $unit = $unit[0];
      }
      else
      {
        $unit = $unit[1];
      }

      $str .= $val . ' ' . $unit . $splitter;
    }

    return substr($str, 0, 0 - strlen($splitter));

  }
    
    
    function timeSince2($time, $from = null)  {
        if ($from == null) {
            $from = time();
        }
        $time = $from - $time;

        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'minute'),
            array(1 , 'second')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($time / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }
}
?>