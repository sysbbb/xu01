<?php
@session_start();
$counterFile = "counter.txt";
$counter = intval(file_get_contents($counterFile));
if($_SESSION['counted']!=1){
$fp = @fopen($counterFile, "w");
if($fp){
flock($fp, 2);
@fwrite($fp, ++$counter);
flock($fp, 3);
fclose($fp);
$_SESSION['counted']=1;
}
}
echo "Nam:" . $counter.":ok";
?>