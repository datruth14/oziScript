<?php
/** Installation Guide (How To Use FAB Widget)
 * After Downloading this widget, 
 * move it into your project file in (assets/widgets/qrcode.php)
 * require it in between  the /*=== WIDGETS ==============/* Comment inside your project file in system_config.php 
 * save and call the widget quick_alert() inside any of your componets root files (components/index.php etc)  and add the required parameters as follows::
 * Sample ::: <?php quick_alert("Message");?>
 * or sample 2 ::: <?php quick_alert2("Title","description","Icon");?>
 * icon 1: "success"
 * icon 2: "warning"
 * icon 3: "info"
 * icon 3: "error"
 * leave empty to see default values or update parameters as it suites you
 * thank you for chosing ozi...
 */


//this will called in your script when you need to send an alert
function quick_alert($basic ="Basic Alert"){
    echo "<script>alert('".$basic."');</script>";
}

//this is a sweet alet component built with ozi script component
function quick_alert2($h1 ="Basic Alert",$p="",$icon="success"){
    echo 
    "<script>
    responsealert('".$h1."','".$p."','".$icon."');
    </script>";
}