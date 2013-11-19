<?php 

date_default_timezone_set('Europe/Lisbon');

$now = strtotime('now');
$end = strtotime("2013-11-19 18:49:30 + 3 days");

function secs_to_h($secs)
    {
        $units = array(
            "week"   => 7*24*3600,
            "day"    =>   24*3600,
            "hour"   =>      3600,
            "minute" =>        60,
            "second" =>         1,
            );

        // specifically handle zero
        if ( $secs == 0 ) return "0 seconds";

        $s = "";

        foreach ( $units as $name => $divisor ) {
            if ( $quot = intval($secs / $divisor) ) {
                $s .= "$quot $name";
                $s .= (abs($quot) > 1 ? "s" : "") . ", ";
                $secs -= $quot * $divisor;
            }
        }

        return substr($s, 0, -2);
    }

$str = secs_to_h($end - $now);
// echo $str;
preg_match_all('/,/', $str, $matches, PREG_OFFSET_CAPTURE);

if(count($matches[0]) >= 2) {
    echo substr($str, 0, $matches[0][1][1]);
} else {
    echo $str;
}

echo '<pre>';print_r($matches);exit;

?>
