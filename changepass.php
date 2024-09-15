<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Change Password</title>
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
            <h1 class="text-center">Change Password</h1>
            <form action="changepass.php" method="post">
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
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="cpassword">CONFIRM PASSWORD</label>
                    <input type="password" class="form-control" id="cpassword" name="cpassword" required>
                </div>
                <button type="submit" class="btn btn-primary">Change Password</button>
                <br><br><br>
                <div class="form-group">
                    <label for="otp">Enter the OTP send to your registered Email ID</label>
                    <input type="text" class="form-control" id="otp" name="otp" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit OTP</button>
            </form>
        </div>
        <?php
            $login = false;
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
            $otp = $_POST["otp"];
            if($otp == ""){
                if($password!=$cpassword){
                    $showError = "Passwords do not match";
                }
                else{
                    $sql = "SELECT * FROM Users WHERE `UserName`='$username' AND `Password`='$password'";
                    $result = mysqli_query($conn, $sql);
                    $num = mysqli_num_rows($result);
                    if ($num == 1){
                        $otp_sent = bin2hex(random_bytes(3));
                        $to = '$email';
                        $subject = 'Changing Password';
                        $message = 'You are trying to change your password. OTP: $otp_sent';
                        $headers = 'From: pankaj6255dav@gmail.com'."\r\n".'Reply-To: pankaj6255dav@gmail.com'."\r\n".'X-Mailer: PHP/'.phpversion();
                        mail($to, $subject, $message, $headers);
                    } 
                    else{
                        $showError = "No such user is registered";
                    }
                }
            }
            else{
                if($otp != $otp_sent){
                    $showError = "The OTP entered is not correct";
                }
                else{
                    $sql = "UPDATE Users SET `Password`='$password' WHERE  `UserName`='$username' AND `Email`=`$email`";
                    $result = mysqli_query($conn, $sql);
                    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success!</strong> Your password has been successfully changed
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div> ';
                    $to = '$email';
                    $subject = 'Changing Password';
                    $message = 'Your password has been successfully changed';
                    $headers = 'From: pankaj6255dav@gmail.com'."\r\n".'Reply-To: pankaj6255dav@gmail.com'."\r\n".'X-Mailer: PHP/'.phpversion();
                    mail($to, $subject, $message, $headers);
                    $showError = false;
                    header("location: login.php");
                    exit;
                }
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