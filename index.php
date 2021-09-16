<?php

session_start();

if(!isset($_SESSION['stored_data'])){
    $_SESSION['stored_data']='';
}
if(!isset($_SESSION['cnt'])){
    $_SESSION['cnt']=0;
}



function validateX($x){
    return isset($x);
}

function validateY($y){
    return isset($y);
}

function validateR($r){
    return isset($r);
}

function validateTime($time){
    return isset($time);
}

function validateForm($x, $y, $r) {
    return is_numeric($x) && $x >= -5 && $x <= 5
        && is_numeric($y) && $y >= -5 && $y <= 5
        && is_numeric($r) && $r >= -5 && $r <= 5;
}


function checkInside($x, $y, $r)
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

function store($para){
    $_SESSION['cnt'] ++;
    $_SESSION['stored_data'] .= "\"" . $_SESSION['cnt'] . "\"";
    $_SESSION['stored_data'] .= ' : ';
    $_SESSION['stored_data'] .= $para;
    $_SESSION['stored_data'] .= ', ';
}

$x = $_GET['x'];
$y = $_GET['y'];
$r = $_GET['r'];
$time = $_GET['time'];
if(validateX($x) && validateY($y) && validateR($r) && validateTime($time)){
    if(!validateForm($x, $y, $r)) echo 'false';
    else{
        $isInside = checkInside($x, $y, $r);
        $hit = $isInside ? 'true' : 'false';
        echo $hit;
        store($x);
        store($y);
        store($r);
        store($hit);
        store("\"$time\"");
    }
}

if(isset($_GET['fetchTable'])){
    echo "{" . substr($_SESSION['stored_data'], 0, -2) . "}";
}

if(isset($_GET['clear'])){
    $_SESSION['stored_data'] = '';
    $_SESSION['cnt'] = 0;
    echo 'true';
}