<?php
$numbers = array(1,2,3,4,5,6,7,8,9,10);

for($i = 0; $i <= count($numbers)-1; $i++)
{
  if ($numbers[$i] % 2 == 0)
  {
  	echo "$numbers[$i] <br>\n";
  }

}
?>
