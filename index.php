<?php
// turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

// require the autoload file
require_once('vendor/autoload.php');

// create an instance of the base class
$f3 = Base::instance();

// define a default route
$f3->route('GET /', function(){

    //troubleshooting
    echo '<h1>Hello world!</h1>';

    $view = new Template();

    //troubleshooting
    echo $view->render('views/home2.html');
    echo '<h1>Hello world!</h1>';
});
// close default

// personal info route
$f3->route('GET|POST /personal-information', function($f3){

    $view = new Template();
    echo $view->render('views/personal-information.html');

});

// profile route
$f3->route('GET|POST /profile', function($f3){

    //troubleshooting
    echo '<h1>Hello world!</h1>';
    //$view = new Template();
    //echo $view->render('views/profile.html');

});

// run fat free
$f3->run();