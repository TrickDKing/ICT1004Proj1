<!DOCTYPE html>

<html lang="en">
    <head>
        <title>Registration Page</title>
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
            <div class="row">
                <h1 class="text-center">Sign up</h1>
            </div>
            <div class="row">
                <form action="process_register.php" method="post">
                    <div class="form-group">
                        <label for="fname">First Name:</label>
                        <input type="text" class="form-control" id="fname" required name="fname" maxlength="45" placeholder="Enter first name">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name:</label>
                        <input type="text" class="form-control" id="lname" required maxlength="45" name="lname" placeholder="Enter last name">
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" class="form-control" id="username" required maxlength="45" name="username" placeholder="Enter username">
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="email" class="form-control" id="email" required name="email" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label for="pwd">Password: (Must contain 1 uppercase, number and 10 characters)</label>
                        <input type="password" class="form-control" id="pwd" name="pwd" placeholder="Enter password">
                    </div>
                    <div class="form-group">                
                        <label for="pwd_confirm">Confirm Password:</label>
                        <input type="password" class="form-control" id="pwd_confirm" name="pwd_confirm" placeholder="Confirm password">
                    </div>
                    <div class="form-group">              
                        <label for="dob">Date of Birth</label>
                        <input type="date" class="form-control" id="dob" required name="dob" placeholder="Enter date of birth" max="2020-11-06">
                    </div>
                    <div class="form-check">
                        <label>
                            <input type="checkbox" required name="agree">
                            I agree to the user agreement, privacy policy, terms and conditions.
                        </label>           
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </main>


    </body>
</html>
