<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Login</title>
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
            <h1 class="text-center">Login to our website</h1>
            <form action="login.php" method="post">
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
                    <input type="password" class="form-control" id="password" name="password" pattern=[a-zA-Z0-9]{10} required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a href="changepass.php">Forgot password</a>
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
            $email = $_POST["email"];
            $sql = "SELECT * FROM Users WHERE `UserName`='$username' AND `Password`='$password'";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 1){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: booking.php");
            } 
            else{
                $showError = "Invalid Credentials";
            }  
            if($login){
                echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> You are logged in
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
