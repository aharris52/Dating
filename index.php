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
        if (!validName($_POST['firstName'])) {
            $f3->set('errors["first"]', "Provide a valid first name please");
        }
        if (!validName($_POST['lastName'])) {
            $f3->set('errors["last"]', "Provide a valid last name please");
        }
        //Ensure applicant is >18yo
        if (!validAge($_POST['age'])) {
            $f3->set('errors["age"]', "Invalid age");
        }
        //must provide phone#
        if (!validPhone($_POST['phone'])) {
            $f3->set('errors["phone"]', "Invalid phone number");
        }

        //If provided data validates
        if (empty($f3->get('errors'))) {

            //Store the data in the session array
            $_SESSION['first'] = $_POST['firstName'];
            $_SESSION['last'] = $_POST['lastName'];
            $_SESSION['age'] = $_POST['age'];
            $_SESSION['gender'] = $_POST['gender'];
            $_SESSION['phone'] = $_POST['phone'];

            //Redirect to profile page (same page)
            $f3->reroute('/profile');
        }
    }

    $f3->set('first', $_POST['firstName']);
    $f3->set('last', $_POST['lastName']);
    $f3->set('age', $_POST['age']);
    $f3->set('gender', $gender);
    $f3->set('phone', $_POST['phone']);

    // if the conditions validate, load the template
    $view = new Template();
    echo $view->render('views/personal-information.html');

});

// profile route
$f3->route('GET|POST /profile', function($f3){

    //get the States and Genders
    $inputState = getStates();
    $seeking = getGender();

    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_SESSION);

        //ensure they provide a valid email
        if(!validEmail($_POST['email'])) {
            $f3->set('errors["email"]', "Invalid email");
        }
        //make sure they filled it out
        if (empty($f3->get('errors'))) {
            //Store the data from post to session array
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['state'] = $_POST['state'];
            $_SESSION['seeking'] = $_POST['seeking'];
            $_SESSION['bio'] = $_POST['bio'];

            //Redirect to interests page
            $f3->reroute('/interests');
        }
    }
    //retrieve from the hive
    $f3->set('selected', $_POST['state']);
    $f3->set('seeks', $_POST['seeking']);
    //store
    $f3->set('email', $_POST['email']);
    $f3->set('state', $inputState);
    $f3->set('seeking', $seeking);


    //"<pre>" . var_dump($_POST). "</pre>";
    //"<pre>" . var_dump($_SESSION). "</pre>";

    //troubleshooting
    //echo '<h1>Hello world!</h1>';
    $view = new Template();
    echo $view->render('views/profile.html');

});

// interest route
$f3->route('GET|POST /interests', function($f3){

    $indoor = getInDoor();
    $outdoor = getOutDoor();

    //If the form has been submitted
    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        //var_dump($_POST);

        if(!validIndoor($_POST['indoor'])) {
            $f3->set('errors["indoor"]', "Please select an indoor activity/ies");
        }

        if(!validOutdoor($_POST['outdoor'])) {
            $f3->set('errors["outdoor"]', "Please select an indoor activity/ies");
        }

        if (empty($f3->get('errors'))) {
            //Store the data in the session array
            $_SESSION['indoor'] = $_POST['indoor'];
            $_SESSION['outdoor'] = $_POST['outdoor'];

            //Redirect to summary page
            $f3->reroute('/summary');
        }
    }

    $f3->set('selected', $_POST['indoor']);
    $f3->set('selectedOut', $_POST['outdoor']);
    $f3->set('indoor', $indoor);
    $f3->set('outdoor', $outdoor);

    //troubleshooting
    //echo '<h1>Hello world!</h1>';
    //"<pre>" . var_dump($_POST). "</pre>";
    //"<pre>" . var_dump($_SESSION). "</pre>";
    $view = new Template();
    echo $view->render('views/interests.html');

});

// summary route
$f3->route('GET|POST /summary', function($f3){

    //troubleshooting
    //echo '<h1>Hello world!</h1>';
    //var_dump($_SESSION);
    $view = new Template();
    echo $view->render('views/summary.html');

});

// run fat free
$f3->run();