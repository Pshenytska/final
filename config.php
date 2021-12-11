<?php
//navigation
define('THIS_PAGE', basename($_SERVER['PHP_SELF']));
$nav['index.php'] = 'Home';
$nav['about.php'] = 'About';
$nav['loans.php'] = 'Loans';
$nav['houses.php'] = 'Houses';
$nav['contact.php'] = 'Contact';

//database connection
ob_start();  // prevents header errors before reading the whole page!
define('DEBUG', 'TRUE');  // We want to see our errors

include('credentials.php');
$first_name = '';
$last_name = '';
$email = '';
$username = '';
$password = '';
$success = '<i class="far fa-thumbs-up"></i>You have successfully logged on!';
$errors = array();
// fuction for navigation
function my_nav($nav)
{
    $my_return = '';
    foreach ($nav as $key => $value) {
        if (THIS_PAGE == $key) {
            $my_return .= '<li><a href=" ' . $key . '" class="current">' . $value . '</a></li>';
        } else {
            $my_return .= '<li><a href=" ' . $key . '">' . $value . '</a></li>';
        } //else
    } //end foreach
    return $my_return;
} //end function


switch (THIS_PAGE) {
    case 'index.php':
        $title = 'Home page - WA Real Estate';
        $body = 'home';
        $headline = '<h1>Welcome to our Home Page of WA Real Estate</h1>';
        $bgcolor = 'background-color:green';
        break;

    case 'about.php':
        $title = 'About page - Screenshots';
        $body = 'about inner';
        $headline = '<h1>About Us</h1>';
        $bgcolor = 'background-color:blue';
        break;

    case 'loans.php':
        $title = 'Loans - WA Real Estate';
        $body = 'daily inner';
        $headline = '<h1>Loans - WA Real Estate</h1>';
        $bgcolor = 'background-color:pink';
        break;

    case 'houses.php':
        $title = 'Houses - WA Real Estate';
        $body = 'project inner';
        $headline = 'Houses - Wa Real Estate';
        break;


    case 'contact.php':
        $title = 'Contact page';
        $body = 'contact inner';
        $headline = '<h1>Welcome to our Contact page</h1>';
        break;

    case 'response.php':
        $title = 'Request Sent';
        $body = 'contact inner';
        $headline = '<h1>Thank you! Your contact request was sent to us!</h1>';
        break;
}



function myError($myFile, $myLine, $errorMsg)
{
    if (defined('DEBUG') && DEBUG) {
        echo 'Error in file: <b> ' . $myFile . ' </b> on line: <b> ' . $myLine . ' </b>';
        echo 'Error message: <b> ' . $errorMsg . '</b>';
        die();
    } else {
        echo ' Houston, we have a problem!';
        die();
    }
}
