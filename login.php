<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<html lang="en">
    <head>
        <title>Sign In</title>
        <?php
        include "head.inc.php";
        ?>
    </head>

    <body>
        <?php
        include "nav.inc.php";
        include "login.nav.inc.php";
        ?>
        <main class="container">
            <h1>Login</h1>
            <form action="process_login.php" method="post"> 
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" required name="email" placeholder="Enter Email">
                </div>
                <div class="form-group">
                    <label for="pwd">Password</label>
                    <input type="password" class="form-control" id="pwd" required name="pwd" placeholder="Enter password">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
        </main>
    </body>
</html>
