<?php
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

    if (1 <= $eer And $eer < 21) return "G";
    if (21 <= $eer And $eer < 39) return "F";
    if (39 <= $eer And $eer < 55) return "E";
    if (55 <= $eer And $eer < 69) return "D";
    if (69 <= $eer And $eer < 81) return "C";
    if (81 <= $eer And $eer < 92) return "B";
    if (92 <= $eer) return "A";

}
?>