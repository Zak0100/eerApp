<?php

function ratingTocolour($eerInput){
         
    $ratingColour = "";

    switch($eerInput){
        case "A":
            $ratingColour = "A";
            return $ratingColour;
        case "B":
            $ratingColour = "B";
            return $ratingColour;
        case "C":
            $ratingColour = "C";
            return $ratingColour;
        case "D":
            $ratingColour = "D";
            return $ratingColour;
        case "E":
            $ratingColour = "E";
            return $ratingColour;
        case "F":
            $ratingColour = "F";
            return $ratingColour;
        case "G":
            $ratingColour = "G";
            return $ratingColour;
        default:
            $ratingColour = "display-container";
            return $ratingColour;
        }
    
}

?>