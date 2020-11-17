<?php

function authenticateUser() {
    global $username, $fname, $lname, $email, $pwd_hashed, $errorMsg, $success;
    // Create database connection.
    $config = parse_ini_file('../../private/db-configproj.ini');
    $conn = new mysqli($config['servername'], $config['username'],
            $config['password'], $config['dbname']);
    // Check connection
    if ($conn->connect_error) {
        $errorMsg = "Connection failed: " . $conn->connect_error;
        $success = false;
    } else {
        // Prepare the statement:
        $stmt = $conn->prepare("SELECT * FROM user WHERE
email=?");
        // Bind & execute the query statement:
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            // Note that email field is unique, so should only have
            // one row in the result set.
            $row = $result->fetch_assoc();
            $fname = $row["fname"];
            $lname = $row["lname"];
            $username = $row["username"];
            $pwd_hashed = $row["password"];
            // Check if the password matches:
            if (!password_verify($_POST["pwd"], $pwd_hashed)) {
                // Don't be too specific with the error message - hackers don't
                // need to know which one they got right or wrong. :)
                $errorMsg = "Email not found or password doesn't match...";
                $success = false;
            }
        } else {
            $errorMsg = "Email not found or password doesn't match...";
            $success = false;
        }
        $stmt->close();
    }
    $conn->close();
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
            $success = true;
            $email = $_POST["email"];
            $pwd_hashed = password_hash($_POST["pwd"], PASSWORD_DEFAULT);

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                authenticateUser();
                if ($success) {
                    session_start();
                    $_SESSION['name'] = $fname . $lname;
                    $_SESSION['username'] = $username;
                    /*echo "<h4>Login successful!</h4>";
                    echo "<h5>Welcome back, " . $fname . " " . $lname . "</h5>";
                    echo "<a href='login.php' class='btn btn-success'>Log-in</a>";*/
                    header('Location: index.php');
                    exit();
                } else {
                    echo "<h3>Oops!</h3>";
                    echo "<h4>The following input errors were detected:</h4>";
                    echo "<p>" . $errorMsg . "</p>";
                    echo "<a href='login.php' class='btn btn-danger'>Return to Login</a>";
                }
            }
            ?>
        </main>
        <br>
        <?php
        include "footer.inc.php";
        ?>
    </body>

</html>
