<?php

// turn on error reporting
ini_set('display_errors',1);
error_reporting(E_ALL);

// require the autoload file
require_once('vendor/autoload.php');
require_once("model/data-layer.php");
require_once("model/validation.php");

//Start a session
session_start();

// create an instance of the base class
$f3 = Base::instance();

// define a default route
$f3->route('GET /', function(){
    //troubleshooting
    //echo '<h1>Hello world!</h1>';

    $view = new Template();
    echo $view->render('views/home2.html');
});


// personal info route
$f3->route('GET|POST /personal-information', function($f3){

    //set gender flag var for validation
    $gender = getGender();

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        //ensure name fields filled-out
        if (!validName($_POST['first'])) {
            $f3->set('errors["first"]', "Provide a valid first name please");
        }
        if (!validName($_POST['last'])) {
            $f3->set('errors["last"]', "Provide a last name please");
        }
        //Ensure applicant is >18yo
        if (!validAge($_POST['age'])) {
            $f3->set('errors["age"]', "Invalid age");
        }
        //must select a gender
        if ($gender == "") {
            $f3->set('errors["gender"]', "Please select a gender");
        }
        //must provide phone#
        if (!validPhone($_POST['phone'])) {
            $f3->set('errors["phone"]', "Invalid phone number");
        }

        //If provided data validates
        if (empty($f3->get('errors'))) {

            //Store the data in the session array
            $_SESSION['first'] = $_POST['first'];
            $_SESSION['last'] = $_POST['last'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['gender'] = $_POST['gender'];
            $_SESSION['phone'] = $_POST['phone'];

            //Redirect to profile page (same page)
            $f3->reroute('/profile');
        }
    }

    $f3->set('first', $_POST['first']);
    $f3->set('last', $_POST['last']);
    $f3->set('age', $_POST['age']);
    $f3->set('gender', $gender);
    $f3->set('phone', $_POST['phone']);

    // if the conditions validate, load the template
    $view = new Template();
    echo $view->render('views/personal-information.html');

});

// profile route
$f3->route('GET|POST /profile', function($f3){

    //troubleshooting
    //echo '<h1>Hello world!</h1>';
    $view = new Template();
    echo $view->render('views/profile.html');

    echo "<pre>" . "post" . var_dump($_POST). "</pre>";
    echo "<pre>" . "session" . var_dump($_POST). "</pre>";

});

// interest route
$f3->route('GET|POST /interests', function($f3){

    //troubleshooting
    echo '<h1>Hello world!</h1>';
    $view = new Template();
    echo $view->render('views/interests.html');

});

// interest route
$f3->route('GET|POST /summary', function($f3){

    //troubleshooting
    echo '<h1>Hello world!</h1>';
    $view = new Template();
    echo $view->render('views/summary.html');

});

// run fat free
$f3->run();