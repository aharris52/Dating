<?php

// turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

// require the autoload file
require_once('vendor/autoload.php');
require_once("model/data-layer.php");
//require_once("model/validation.php");

//Start a session
session_start();

// create an instance of the base class
$f3 = Base::instance();
$validation = new Validation();
$controller = new Controller($f3, $validation);

// define a default route
$f3->route('GET /', function(){
    //troubleshooting
    //echo '<h1>Hello world!</h1>';
    $GLOBALS['controller']->home();
});

// personal
$f3->route('GET|POST /personal-information', function() {
    $GLOBALS['controller']->personal();
});

// profile route
$f3->route('GET|POST /profile', function(){
    //echo '<h1>Welcome to my new profile page!</h1>';
    //echo($_POST);
    $GLOBALS['controller']->profile();
});

// interest route
$f3->route('GET|POST /interests', function(){
    $GLOBALS['controller']->interests();
});

// summary route
/*$f3->route('GET|POST /summary', function($f3){

    //troubleshooting
    //echo '<h1>Hello world!</h1>';
    //var_dump($_SESSION);
    //var_dump($_POST);
    $view = new Template();
    echo $view->render('views/summary.html');

});*/

// summary
$f3->route('GET /summary', function() {
    $GLOBALS['controller']->summary();
});

// run fat free
$f3->run();