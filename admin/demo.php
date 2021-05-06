<?php

/*date_default_timezone_set("Asia/Kolkata");
$cdate=date('d-m-Y H:m:s');
echo $cdate;*/

date_default_timezone_set("Asia/Kolkata");
$cdate=strtotime(date('H:i:s', time()));
echo $cdate;

$checkTime = strtotime('12:43:59');
echo '<hr>';

$diff = abs($cdate - $checkTime);
echo $diff;
echo '<hr>';
echo ceil($diff/60);

?>