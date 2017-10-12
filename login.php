<?php
include_once 'includes/database.php';
session_start();

//if (isset($_SESSION['usr_id']) != "") {
//    header("Location: index.php");
//}

//include_once 'dbconnect.php';

//check if form is submitted
if (isset($_POST['login'])) {

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $passwordEntered = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    //$email = filter_input(INPUT_POST, 'email');
    //$email = filter_var(':email', FILTER_SANITIZE_EMAIL);
    //$passwordEntered = filter_input(INPUT_POST, 'password');
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = true;
        $email_error = "Please Enter Valid Email ID";
    }


    $query = "SELECT * FROM users WHERE email = :email";
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $row = $statement->fetch();
    
    
        $id = $row['id'];

        //get hashed password          
        $hashed_password = $row['password'];
       
        
        $email = $row['email'];
        $usertype = $row['usertype'];
      
        
        //verify the password 
        if (password_verify($passwordEntered, $hashed_password  )&& $usertype==0) {
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['usertype'] = $usertype;
           
            echo 'Password is valid!';
            header('Location: index.php');
        }
            else if(password_verify($passwordEntered, $hashed_password )&& $usertype==1){
            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['usertype'] = $usertype;
           
            echo 'Password is valid!';
            header('Location: admin.php');
                
            }
        } else {
            $errormsg = "Login Failed";
            
        }
    

    ?>

    <!DOCTYPE html>
    <html>
        <head>
            <title>PHP Login Script</title>
            <meta content="width=device-width, initial-scale=1.0" name="viewport" >
            <link href="css/mainpage.css" rel="stylesheet" type="text/css"/>
            <link href="css/common.css" rel="stylesheet" type="text/css"/>
            <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        </head>
        <body>
             <style>
        body
        {
            background-image: url("images/download (1).png");

        }
    </style>
    <body>

        <div class="collapse navbar-collapse" id="navbar1">
            <ul class="nav navbar-nav navbar-right" >
                <?php if (isset($_SESSION['id'])) { ?>
                    <li><p class="navbar-text">Signed in as <?php echo $_SESSION['email']; ?></p></li>
                    <li><a href="logout.php">Log Out</a></li>
                <?php } else { ?>
                    <li><a href="login.php">Login</a></li>
                    <li><a href="register.php">Sign Up</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>


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
<script src="JS/new.js" type="text/javascript"></script>
<script src="JS/index.js" type="text/javascript"></script>

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
    <br>
    <br>
    

            <div class="container">
                <div class="row">
                    <div class="col-md-4 col-md-offset-4 well">
                        <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform">
                            <fieldset>
                                <legend>Login</legend>

                                <div class="form-group">
                                    <label for="name">Email</label>
                                    <input type="text" name="email" placeholder="Your Email" required class="form-control" />
                                    <span class="text-danger"><?php if (isset($email_error)) echo htmlspecialchars($email_error, ENT_QUOTES); ?></span><span class="text-danger">
                                </div>

                                <div class="form-group">
                                    <label for="name">Password</label>
                                    <input type="password" name="password" placeholder="Your Password" required class="form-control" />
                                    
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="login" value="Login" class="btn btn-primary" />
                                </div>
                            </fieldset>
                        </form>
                        <span class="text-danger"><?php if (isset($errormsg)) {
        echo htmlspecialchars($errormsg,ENT_QUOTES);
    } ?></span>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">	
                    New User? <a href="register.php">Sign Up Here</a>
                </div>
            </div>
        </div>

        <script src="js/jquery-1.10.2.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </body>
    <footer><?php require_once("includes/footer.php"); ?></footer>
</html>
