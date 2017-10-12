<?php
include_once 'includes/database.php';
session_start();

if (isset($_SESSION['usr_id'])) {
    header("Location: index.php");
}



//set validation error flag as false
$error = false;

//check if form is submitted
if (isset($_POST['signup'])) {


    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $cpassword = filter_input(INPUT_POST, 'cpassword', FILTER_SANITIZE_STRING);

    $query = "SELECT email FROM users WHERE email=:email";
    $statement1 = $db->prepare($query);
    $statement1->bindValue(":email", $email);
    $statement1->execute();
    $totalEmail = $statement1->fetch();
    $statement1->closeCursor();

    echo $totalEmail["email"];
    if($totalEmail["email"]==$email){
    $error = true;
    $emailError1 = "Provided Email is already in use.";
    
     }
    
//    print_r("<pre>");
//print_r($totalEmail );  //for trouble shooting showing results are correct
//print_r("<pre>");

    $p1 = '/[A-Z]/'; //Uppercase
    $p2 = '/[a-z]/'; //Lowercase
    $p3 = '/[0-9]/'; //Numbers
    $p4 = '/!#$%^&*{}()<.>]/'; //Special Characters

    if (!preg_match("/^[a-zA-Z ]+$/", $username)) {
        $error = true;
        $name_error = "Name must contain afirstname and surname";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }
    if (strlen($password) < 8) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters";
    }
    if ($password != $cpassword) {
        $error = true;
        $cpassword_error = "Passwords Do not Match";
    }
    //Check password has uppercase
    if (!preg_match($p1, $password)) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters with Uppercase,lowercase,numbers and symbols";
    }
//Check password has lowercase
    if (!preg_match($p2, $password)) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters with Uppercase,lowercase,numbers and symbols";
    }
//Check password has numbers
    if (!preg_match($p3, $password)) {
        $error = true;
        $password_error = "Password must be minimum of 6 characters with Uppercase,lowercase,numbers and symbols";
    }
//Check password has symbols
//    if (!preg_match($p4, $password)) {
//        $error = true;
//        $password_error = "Password must be minimum of 6 characters with Uppercase,lowercase,numbers and symbols";
//    }
    if (!$error) {


//Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//Create the SQL insert statement
        $query = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";

//Use PDO to sanatise the input
        $statement = $db->prepare($query);

//Bind the variable to the placeholders in the query
        $statement->bindValue(':name', $username);
        $statement->bindValue(':email', $email);
        $statement->bindValue(':password', $hashed_password);

//Add the user to the database
        $statement->execute();

        $successmsg = "Thank you for registering";
        //   $statement->closeCurser();
    } else {
        $errormsg = "Error in registering...Email is allread in use or not a valid email entered  !";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>User Registration Script</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" >
        <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/common.css" rel="stylesheet" type="text/css"/>
        <link href="css/mainpage.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <style>
            body
            {
                background-image: url("images/download (1).png");

            }
        </style>
    <body>



        <div class ="social">
            <img id = "mask" src = "images/collagerugby.jpg">
        </div>

        <div class="social">
            <a href="https://twitter.com/IrishRugby?ref_src=twsrc%5Egoogle%7Ctwcamp%5Eserp%7Ctwgr%5Eauthor"><i id="twitter" class="icon-twitter"></i></a>
            <i id="code" class="icon-code"></i>
            <i id="plus" class="icon-google-plus-sign"></i>
            <i id="mail" class="icon-envelope"></i> 
        </div>
        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

        <script src="js/index.js"></script>

        <nav id="nav-1">

            <a class="link-1" href="index.php">Home</a>
            <a class="link-1" href="#">About</a>
            <a class="link-1" a href="#chapter4">Fixtures</a>
            <a class="link-1" href="register.php">Login/Register</a>
        </nav>


        <main>
            <br>
            <br>
            <br>
            <br>
            <br>

            <br>
            <br>
            <br>
            <br>



            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 well">
                        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="signupform">
                            <fieldset>
                                <legend>Sign Up</legend>

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" placeholder="Enter Full Name" required value="<?php if ($error) echo $username; ?>" class="form-control" />
                                    <span class="text-danger"><?php if (isset($name_error)) echo htmlspecialchars($name_error, ENT_QUOTES); ?></span>
                                </div>

                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="text" name="email" placeholder="Email" required value="<?php if ($error) echo $email; ?>" class="form-control" />
                                    <span class="text-danger"><?php if (isset($email_error)) echo htmlspecialchars($email_error, ENT_QUOTES); ?></span><span class="text-danger">
                                        <span class="text-danger"><?php if (isset($email_error1)) echo htmlspecialchars($email_error1, ENT_QUOTES); ?></span><span class="text-danger">
                                            </div>

                                            <div class="form-group">
                                                <label for="name">Password</label>
                                                <input type="password" name="password" placeholder="Password" required class="form-control" />
                                                <span class="text-danger"><?php if (isset($password_error)) echo htmlspecialchars($password_error, ENT_QUOTES); ?></span>
                                            </div>

                                            <div class="form-group">
                                                <label for="name">Confirm Password</label>
                                                <input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
                                                <span class="text-danger"><?php if (isset($cpassword_error)) echo htmlspecialchars($cpassword_error, ENT_QUOTES); ?></span>
                                            </div>

                                            <div class="form-group">
                                                <input type="submit" name="signup" value="Sign Up" class="btn btn-primary" />
                                            </div>
                                            </fieldset>
                                            </form>
                                            <span class="text-success"><?php
if (isset($successmsg)) {
    echo $successmsg;
}
?></span>
                                            <span class="text-danger"><?php
                                                if (isset($errormsg)) {
                                                    echo $errormsg;
                                                }
                                                ?></span>
                                            </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 col-md-offset-4 text-center">	
                                                    Already Registered? <a href="login.php">Login Here</a>
                                                </div>
                                            </div>
                                            </div>
                                            <script src="js/jquery-1.10.2.js"></script>
                                            <script src="js/bootstrap.min.js"></script>
                                            </body>
                                            </html>






                                            </body>
                                            <footer><?php require_once("includes/footer.php"); ?></footer>
                                            </html>