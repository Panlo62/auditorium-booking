<!doctype html>
<html lang="en">
	<head>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    	<title>List Of Events</title>
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
        <?php
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
    	    $sql = "SELECT * FROM `Bookings`"; 
        	$result = mysqli_query($conn, $sql);
	        while($row = mysqli_fetch_assoc($result)){
    	    	$id = $row['EventID'];
	        	$eventname = $row['EventName'];
    	      	$description = $row['Description'];
				$date = $row['Date'];
        	  	echo '<div class="col-md-4 my-2">
						<div class="card" style="width: 18rem;">
                      		<div class="card-body">
                          		<h5 class="card-title"><a href="event.php?id=' . $id . '">' . $eventname . '</a></h5>
								<h6>Date: $date</h6>
                          		<p class="card-text">'.$description. '</p>
                      		</div>
                  		</div>
                	</div>';
        	} 
        ?>    
  	</body>
</html>
