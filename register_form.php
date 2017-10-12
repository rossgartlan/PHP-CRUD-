<?PHP
//Add the database connection
require_once("includes/database.php");
if (isset($_POST['signup'])) {
        $name = filter_input(INPUT_POST,['name'],FILTER_SANITIZE_STRING);
	$email = filter_input(INPUT_POST,['email'],FILTER_SANITIZE_EMAIL);
	$password = filter_input(INPUT_POST,['password'],FILTER_SANITIZE_STRING);
	$cpassword = filter_input(INPUT_POST,['cpassword'],FILTER_SANITIZE_STRING);
	
	//name can contain only alpha characters and space
	if (!preg_match("/^[a-zA-Z ]+$/",$name)) {
		$error = true;
		$name_error = "Name must contain only alphabets and space";
	}
	if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
		$error = true;
		$email_error = "Please Enter Valid Email ID";
	}
	if(strlen($password) < 6) {
		$error = true;
		$password_error = "Password must be minimum of 6 characters";
	}
	if($password != $cpassword) {
		$error = true;
		$cpassword_error = "Password and Confirm Password doesn't match";
        }
}
//?>

<html>
<head>
	<title>User Registration Script</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport" >
	<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css" />
        <link href="css/common.css" rel="stylesheet" type="text/css"/>
</head>
<body>

<nav class="navbar navbar-default" role="navigation">
	<div class="container-fluid">
		<!-- add header -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar1">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="index.php"></a>
		</div>
		<!-- menu items -->
		<div class="collapse navbar-collapse" id="navbar1">
			<ul class="nav navbar-nav navbar-right">
				<li><a href="login.php">Login</a></li>
				<li class="active"><a href="register.php">Sign Up</a></li>
			</ul>
		</div>
	</div>
</nav>

<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4 well">
			<form form action ="register.php" method ="post"  name="signupform">
				<fieldset>
					<legend>Sign Up</legend>

					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" name="username" placeholder="Enter Full Name" required class="form-control" />
						<span class="text-danger"><?php if (isset($name_error)) echo htmlspecialchars($name_error,ENT_QUOTES); ?></span>
					</div>
					
					<div class="form-group">
						<label for="name">Email</label>
						<input type="text" name="email" placeholder="Email" required class="form-control"/>
						<span class="text-danger"><?php if (isset($email_error)) htmlspecialchars($email_error,ENT_QUOTES); ?></span>
					</div>

					<div class="form-group">
						<label for="name">Password</label>
						<input type="password" name="password" placeholder="Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($password_error)) echo htmlspecialchars($password_error,ENT_QUOTES); ?></span>
					</div>

					<div class="form-group">
						<label for="name">Confirm Password</label>
						<input type="password" name="cpassword" placeholder="Confirm Password" required class="form-control" />
						<span class="text-danger"><?php if (isset($cpassword_error)) echo htmlspecialchars($cpassword_error,ENT_QUOTES); ?></span>
					</div>

					<div class="form-group">
						<input type="submit" name="signupform" value="" class="btn btn-primary" />
					</div>
				</fieldset>
			</form>
			<span class="text-success"><?php if (isset($successmsg)) { echo htmlspecialchars($successmsg,ENT_QUOTES); } ?></span>
			<span class="text-danger"><?php if (isset($errormsg)) { echo htmlspecialchars($errormsg,ENT_QUOTES); } ?></span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-4 col-md-offset-4 text-center">	
		Already Registered? <a href="login.php">Login Here</a>
		</div>
	</div>
</div>
<script src="JS/jquery-1.10.2.js"></script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
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
<br/>
<link href="css/common.css" rel="stylesheet" type="text/css"/>

<br/>

</body>
</html>