<!DOCTYPE html>
<html>
<body>

<?php
require_once "notLoggedIn.php";
function EERCalc($tfa, $lc, $hc, $hwc)
{
    $ecd = 0.21;
    $tec = $lc + $hc + $hwc;
    $ecf = 0;
    $ecf = $ecd * ( $tec / ( $tfa + 45 ));


    if ( $ecf < 3.5 )
    {
        $eer = 100-(13.95 * $ecf);
    } else 
    {
        $eer = 117 - (121 * log($ecf, 10));
    }
    
	return round($eer); 
    if (1 <= $eer And $eer < 21) return "G";
    if (21 <= $eer And $eer < 39) return "F";
    if (39 <= $eer And $eer < 55) return "E";
    if (55 <= $eer And $eer < 69) return "D";
    if (69 <= $eer And $eer < 81) return "C";
    if (81 <= $eer And $eer < 92) return "B";
    if (92 <= $eer) return "A";
    

}


$vals = array(
  array(48, 70, 375, 190),
  array(45, 65, 771, 158),
  array(67, 109, 654, 157),
  array(89, 207, 1156, 195),
  array(55, 79, 970, 168),
  array(78, 106, 779, 155),
  array(76, 109, 1008, 187),
  array(77, 135, 1014, 169),
  array(77, 111, 439, 172),
  array(82, 129, 1041, 161),
  array(42, 74, 508, 156),
  array(77, 144, 1617, 326)
);


foreach($vals as $property){
	//var_dump($property);
	echo EERCalc($property[0], $property[1], $property[2], $property[3]). "</br>";
}



?> 

</body>
</html>