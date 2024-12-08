<?php 
require 'vendor/autoload.php';

use Carbon\Carbon;
//use Carbon\CarbonImmutable;


//call this function and pass in your timestamp and get result in diffforhumans
function carbon($timestamp = "2022-09-02 01:19:39"){
    echo Carbon::parse($timestamp)->diffForHumans();  // 50 minutes after
}

//call this in your script
//date_diffforhumans("timestap here");

//learn more from
//https://carbon.nesbot.com/docs/
