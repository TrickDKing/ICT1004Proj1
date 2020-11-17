<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function saveMembertoDB() {
    global $fname, $lname, $email, $pwd_hashed, $dob, $username, $errorMsg, $success;

    $config = parse_ini_file("../../private/db-configproj.ini");
    $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    //check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        //Prepared statement

        $stmt = $conn->prepare("INSERT INTO user (fname, lname, email, password, dob, username) VALUES (?, ?, ?, ?, ?, ?)");

        //bind & execute the query statement:
        $stmt->bind_param("ssssss", $fname, $lname, $email, $pwd_hashed, $dob, $username);

        if (!$stmt->execute()) {
            $errorMsg = "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
}

$email = $lname = $fname = $dob = $username = $pwd_hashed = $errorMsg = "";

$success = true;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //First name
    if (!empty($_POST["fname"])) {
        $fname = sanitize_input($_POST["fname"]);
    }

    //Last name
    if (empty($_POST["lname"])) {
        $errorMsg .= "Last name is required.<br>";
        $success = false;
    } else {
        $lname = sanitize_input($_POST["lname"]);
    }

    //username
    if (empty($_POST["username"])) {
        $errorMsg .= "Username is required.<br>";
        $success = false;
    } else {
        $username = sanitize_input($_POST["username"]);
    }

    //dob
    if (empty($_POST["dob"])) {
        $errorMsg .= "Date of Birth is required.<br>";
        $success = false;
    } else {
        $dob = date("Y-m-d", strtotime($dob));
        $dob = sanitize_input($_POST["dob"]);
    }

    //Email
    if (empty($_POST["email"])) {
        $errorMsg .= "Email is required.<br>";
        $success = false;
    } else {
        $email = sanitize_input($_POST["email"]);
        //Additional check to make sure e-mail address is well-formed.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errorMsg .= "Invalid email format.";
            $success = false;
        }
    }

    //Password


    if (empty($_POST["pwd"]) || empty($_POST["pwd_confirm"])) {
        $errorMsg .= "Password or confirmation is a required field.<br>";
        $success = false;
    } else {
        //Make sure passwords match
        if ($_POST["pwd"] != $_POST["pwd_confirm"]) {
            $errorMsg .= "Passwords do not match.<br>";
            $success = false;
        } elseif (checkPassword($_POST["pwd"])== False || checkPassword($_POST["pwd_confirm"]) == False) {
            $errorMsg .= "Check if password are at least 10 characters and contains 1 uppercase, lowercase and number.<br>";
            $success = false;
        } else {
            $pwd_hashed = password_hash($_POST["pwd"], PASSWORD_DEFAULT);
        }
    }
    //echo "<script type='text/javascript'>alert('test');</script>";

    saveMembertoDB();
} else {
    echo "<h2>This page is not meant to be executed directly.</h2>";
    echo "<p>You can register at the link below:</p>";
    echo "<a href='register.php'>Go to Sign Up page</a>";
    exit();
}

function checkPassword($pwdStr) {
    $uppercase = preg_match('@[A-Z]@', $pwdStr);
    $lowercase = preg_match('@[a-z]@', $pwdStr);
    $number = preg_match('@[0-9]@', $pwdStr);
    if (!$uppercase || !$lowercase || !$number || strlen($password) < 10) {
        // tell the user something went wrong
        //$errorMsg = "Enter a password with more than 10 characters with 1 uppercase, lowercase and number!";
        return False;
    }
    return True;
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return($data);
}
?>



<html lang="en">
    <head>
        <title>Registration Results</title>
        <?php
        include "head.inc.php";
        ?>
    </head>
    <body>
        <?php
        include "nav.inc.php";
        ?>
        <main class="container">
            <?php
            if ($success) {
                echo "<h4>Your registration is successful!</h4>";
                echo "<h5>Thank you for signing up, " . $fname . " " . $lname . ".</h5>";
                echo "<a href='login.php' class='btn btn-success'>Log-in</a>";
            } else {
                echo "<h3>Oops!</h3>";
                echo "<h4>The following input errors were detected:</h4>";
                echo "<p>" . $errorMsg . "</p>";
                echo "<a href='register.php' class='btn btn-danger'>Return to Sign Up</a>";
            }
            ?>
        </main>
        <br>

    </body>

</html>
