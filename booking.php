<!doctype html>
<html lang="en">
	<head>
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	    <title>Auditorium Booking</title>
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
    		<h1 class="text-center">AUDITORIUM BOOKING</h1>
     		<form action="booking.php" method="post">
        		<div class="form-group">
            		<label for="eventname">EVENT NAME</label>
	            	<input type="text" class="form-control" id="eventname" name="eventname" required>
                </div>
        		<div class="form-group">
            		<label for="description">DESCRIPTION</label>
            		<input type="text" class="form-control" id="description" name="description" required>
        		</div>
                <div class="form-group">
            		<label for="date">CHOOSE THE DATE</label>
            		<input type="date" class="form-control" id="date" name="date" required>
        		</div>
		        <button type="submit" class="btn btn-primary ">Book Auditorium</button>
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
			$eventname = $_POST["eventname"];
			$description = $_POST["description"];
			$date = $_POST["date"];
			$sql = "SELECT * FROM Bookings WHERE Date=$date";
			$num = mysqli_num_rows($sql);
			if($num==0){
				$sql = "INSERT INTO `Bookings` (`EventId`, `EventName`, `Description`, 'Date', `BookedOn`) VALUES (NULL, '$eventname', '$description', '$date', current_timestamp())";
				$result = mysqli_query($conn, $sql);
				$sql = "SELECT EventID FROM Bookings WHERE `Date`=$Date And `EventName`=`$eventname`";
				$result = mysqli_query($conn, $sql);
				$row = mysql_fetch_assoc($result);
				$eventid = $row[`EventID`];
				$bookedOn = $row[`BookedOn`];
				$email = $row['Email'];
                //$_SESSION['username'] = $username;
				$to = '$email';
			    $subject = 'Auditorium Booking Confirmation';
			    $message = 'Your booking of the Auditorium has been successfully made with the following details\nEvent Name: $eventname\nDate: $date\nEvent Description: $description\nEvent ID: $eventid\nBooked On: $bookedOn';
    			$headers = 'From: pankaj6255dav@gmail.com'."\r\n".'Reply-To: pankaj6255dav@gmail.com'."\r\n".'X-Mailer: PHP/'.phpversion();
				mail($to, $subject, $message, $headers);
				header("location: event.php");
				exit;
			}
			else{
				echo ' <div class="alert alert-danger alert-dismissible fade show" role="alert">
						<strong>Error!</strong> The auditorium is already booked for the date: $date
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div> ';
			}
		?>
	</body>
</html>