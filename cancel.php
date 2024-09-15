<!doctype html>
<html lang="en">
    <head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <title>Booking Cancelation</title>
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
            <h1 class="text-center">Booking Cancelation</h1>
            <form action="cancel.php" method="post">
                <div class="form-group">
                    <label for="eventid">EVENT ID</label>
                    <input type="text" class="form-control" id="eventid" name="eventid" aria-describedby="emailHelp" required>
                </div>
                <div class="form-group">
                    <label for="date">EVENT DATE</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="">
                    <label for="check">Are you sure you want to cancel the booking?</label>
                    <input type="checkbox" class="form-control" id="check" required>
                </div>
                <button type="submit" class="btn btn-primary">Cancel Booking</button>
            </form>
			<br>
			<p>A mail will be sent to the registered Email-ID shortly after the booking</p>
        </div>
        <?php
            session_start();
			if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
				header("location: login.php");
				exit;
			}
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
            $eventid = $_POST["eventid"];
            $date = $_POST["date"]
            $sql = "SELECT * FROM Bookings WHERE `Date`=`$date` AND `EventID`=`$eventid`";
            $result = mysqli_query($conn, $sql);
            $num = mysqli_num_rows($result);
            if ($num == 1){
                $sql = "DELETE FROM Bookings WHERE `Date`='$date' AND `EventID`=`$eventid`";
                $result = mysqli_query($conn, $sql);
                $sql = "SELECT EventID FROM Bookings WHERE `Date`=$Date And `EventID`=`$eventid`";
				$result = mysqli_query($conn, $sql);
				$row = mysql_fetch_assoc($result);
				$eventname = $row[`EventName`];
				$bookedOn = $row[`BookedOn`];
                $email = $row['Email'];
                $to = '$email';
			    $subject = 'Auditorium Booking Cancelation';
				$message = 'Your booking of the Auditorium with the following details has been canceled\nEvent Name: $eventname\nDate: $date\nEvent ID: $eventid\nBooked On: $bookedOn';
    			$headers = 'From: pankaj6255dav@gmail.com'."\r\n".'Reply-To: pankaj6255dav@gmail.com'."\r\n".'X-Mailer: PHP/'.phpversion();
    			mail($to, $subject, $message, $headers);
                echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> Your booking on Date: $date with EventID: $eventid has been canceled.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div> ';
                header("location: booking.php");
            } 
            else{
                echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> There is no booking on Date: $date with EventID: $eventid
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div> ';
            }
        ?>
    </body>
</html>
