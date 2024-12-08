<?php 

//The function can be used in your HTML to create links that make AJAX requests and update part of the page dynamically.
// For example:  linkTo('dashboard');


function linkTo($screen="",$params="") {
   echo 'hx-get="?s='.$screen.'&&'.$params.'" hx-push-url="true" hx-target="#content"';
}