<?php

function validateX($x){
    return isset($x);
}

function validateY($y){
    return isset($y);
}

function validateR($r){
    return isset($r);
}

function validateForm($x, $y, $r) {
    return validateX($x) && validateY($y) && validateR($r);
}


function checkInside($x, $y, $r): bool
{
    if($x > $r) return false;
    if($x < -$r) return false;
    if($y > $r) return false;
    if($y < -$r) return false;
    if($x < 0 && $y < 0) return false;
    if($x <= 0) return !($x * $x + $y * $y > $r * $r);
    else if($y > 0)  return abs($x-$r) > 2*$y;
    return true;
}

// Main logic

if(validateForm($_GET['x'], $_GET['y'],$_GET['r'])) {
    $x = (double)$_GET['x'];
    $y = (double)$_GET['y'];
    $r = (double)$_GET['r'];
    $isValid = validateForm($x, $y, $r);
    $isInside = checkInside($x, $y, $r);
    if($isInside) echo 'true';
    else echo 'false';
}
