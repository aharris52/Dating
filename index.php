<?php
//Turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

// require the autoload file/s
require_once('vendor/autoload.php');

// create an instance of the F3 base class
$f3 = Base::instance();

// define a default route
$f3->route('GET /', function(){
    //echo '<h1>Hello world!</h1>';
    $view = new Template();
    echo $view->render('view/home.html');
});
// run fat free
$f3->run();