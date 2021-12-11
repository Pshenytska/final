<?php
session_start();
include('config.php');
//this is where we will place header.php

$iConn = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die(myError(__FILE__, __LINE__, mysqli_connect_error()));

//register the user
//if isset 

if (isset($_POST['reg_user'])) {
    $first_name = mysqli_real_escape_string($iConn, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($iConn, $_POST['last_name']);
    $email = mysqli_real_escape_string($iConn, $_POST['email']);
    $username = mysqli_real_escape_string($iConn, $_POST['username']);
    $password_1 = mysqli_real_escape_string($iConn, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($iConn, $_POST['password_2']);

    if (empty($first_name)) {
        array_push($errors, 'First name is required to fill in!');
    }

    if (empty($last_name)) {
        array_push($errors, 'Last name is required to fill in!');
    }

    if (empty($email)) {
        array_push($errors, 'Email is required to fill in!');
    }

    if (empty($username)) {
        array_push($errors, 'Username is required to fill in!');
    }

    if (empty($password_1)) {
        array_push($errors, 'Your password is required to fill in!');
    }

    if ($password_1 !== $password_2) {
        array_push($errors, 'Your passwords do not match!');
    }

    //we are checking the username and passowrd, selecting it from the table

    $user_check_query = "SELECT * FROM users WHERE username ='$username' OR email = '$email' LIMIT 1 ";
    $result = mysqli_query($iConn, $user_check_query) or die(myError(__FILE__, __LINE__, mysqli_error($iConn)));

    $rows = mysqli_fetch_assoc($result);

    if ($rows) {
        if ($rows['username'] == $username) {
            array_push($errors, 'This username already exists. Please use different one!');
        }

        if ($rows['email'] == $email) {
            array_push($errors, 'This email already exists. Please use different one!');
        }
    }

    if (count($errors) == 0) {
        $password = md5($password_1);


        $query = "INSERT INTO users (first_name, last_name, email, username, password) VALUES ('$first_name', '$last_name', '$email', '$username', '$password')";

        mysqli_query($iConn, $query);

        $_SESSION['username'] = $username;
        $_SESSION['success'] = $success;

        header('Location:login.php');
    }
// YOU DID NOT CLOSE THE IF ISSET FOR THE REGISTER PART OF THE PHP, I ADDED THE CLOSING BRACE
}

    if (isset($_POST['login_user'])) {
        $username = mysqli_real_escape_string($iConn, $_POST['username']);
        $password = mysqli_real_escape_string($iConn, $_POST['password']);

        if (empty($username)) {
            array_push($errors, 'Username is required!');
        }

        if (empty($password)) {
            array_push($errors, 'Password is required!');
        }

        if (count($errors) == 0) {
            $password = md5($password);
      // THE COUNT WAS CLOSED HERE!!!!  I REMOVED IT!
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password' ";

        $results = mysqli_query($iConn, $query);


        if (mysqli_num_rows($results) == 1) {
            $_SESSION['username'] = $username;
            $_SESSION['success'] = $success;

            header('Location:index.php');
        } else {
            array_push($errors, 'Wrong username/password combo!');
        }

        }//end count
    }  // end isset log in
