<?php
/*
A few different ways to reverse a string
Version 0.1.0 13/03/2019
*/
function reverseString($string){
    $reverse = $string;

    //First way - kinda php specific
    $reverseExpl = str_split($reverse);
    krsort($reverseExpl);
    $reverseFinal = implode("", $reverseExpl);
    echo "First way: " . $reverseFinal;
    echo "<br />";

    //Second way - more universal strlen can be replaced with whatever built in function for getting the length of a string
    $strLength = strlen($reverse);
    for ($i=$strLength; $i >= 0; $i--) {
        $reverseFinal[$reverse[$i]];
    }
    echo "Second way: " . $reverseFinal;
    echo "<br />";
}
reverseString("0123456789"); //easy to tell if the string is in reverse if using a string of numbers :)
?>
