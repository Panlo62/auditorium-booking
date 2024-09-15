<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Register</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <a class="navbar-brand navbar-light" href="#">
                    <img src="partials\6035e2f49ed05dd3e8e975b7_Smlogo-p-500.png" width="100" height="50" alt="">
                </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="booking.php">Auditorium Booking<span class="sr-only"></span></a>
                    </li>
					<li class="nav-item">
            			<a class="nav-link" href="cancel.php">Booking Cancelation</a>
          			</li>
                    <li class="nav-item">
                        <a class="nav-link" href="event.php">Events</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="delacc.php">Delete Account</a>
                    </li>
                </ul>
            </div>
        </nav>
        <div class="container my-4">
            <h1 class="text-center">Signup to our website</h1>
            <form action="register.php" method="post">
                <div class="form-group">
                    <label for="username">USERNAME</label>
                    <input type="text" class="form-control" id="username" name="username" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="email">EMAIL ID</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">PASSWORD</label>
                    <input type="password" class="form-control" id="password" name="password" pattern="[a-zA-Z0-9]{10}" title="Enter a 10 character long alphanumeric password" required>
                </div>
                <div class="form-group">
                    <label for="cpassword">CONFIRM PASSWORD</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" pattern="[a-zA-Z0-9]{10}" required>
                </div>
                <button type="submit" class="btn btn-primary ">Register</button>
            </form>
			<br>
			<p>A mail will be sent to the registered Email-ID shortly after the creation of the account</p>
        </div>
        <?php
            $showAlert = false;
            $showError = false;
            $server = "localhost";
            $username = "root";
            $password = "";
            $database = "Auditorium";
            $conn = mysqli_connect($server, $username, $password, $database);
            if (!$conn){
                echo "success";
            }
            else{
                die("Error". mysqli_connect_error());
            }
            $username = $_POST["username"];
            $password = $_POST["password"];
            $cpassword = $_POST["cpassword"];
            $email = $_POST["email"];
            if(mysqli_num_rows(mysqli_quert($conn,"SELECT * FROM Users WHERE UserName=$username"))!=0){
                $showerror = "A user with username: $username already exists";
            }
            else if(mysqli_num_rows(mysqli_quert($conn,"SELECT * FROM Users WHERE Email=$email"))!=0){
                $showerror = "Email ID $email is already being used by another user";
            }
            else if($password != $cpassword){
                $showError = "Passwords do not match";
            }
            else{
                $sql = "INSERT INTO `Users` ( `UserName`, `Password`, `Email`, `CreatedOn`) VALUES ('$username', '$password', $email, current_timestamp())";
                $result = mysqli_query($conn, $sql);
                if ($result){
                    $showAlert = true;
                }
                $to = '$email';
			    $subject = 'Account Creation';
			    $message = 'Your account with Username: $username has been successfully created';
    			$headers = 'From: pankaj6255dav@gmail.com'."\r\n".'Reply-To: pankaj6255dav@gmail.com'."\r\n".'X-Mailer: PHP/'.phpversion();
				mail($to, $subject, $message, $headers);
            }
            if($showAlert){
                echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your account has been created. You can login now.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                        </button>
                    </div> ';
            }
            if($showError){
                echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> '. $showError.'
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div> ';
            }
        ?>
    </body>
</html>
