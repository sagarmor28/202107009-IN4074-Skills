<?php
// Check existence of id parameter before processing further
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "config.php";

    // Prepare a select statement
    $sql = "SELECT * FROM flights WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_GET["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                /* Fetch result row as an associative array. Since the result set
                contains only one row, we don't need to use while loop */
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Retrieve individual field value
                $FlightNumber = $row["FlightNumber"];
                $DepartureCity = $row["DepartureCity"];
                $DestinationCity = $row["DestinationCity"];
                $DepartureTime = $row["DepartureTime"];
            } else {
                // URL doesn't contain valid id parameter. Redirect to error page
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // URL doesn't contain id parameter. Redirect to error page
    header("location: error.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Information</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Navigation Section -->
  <nav>
  <ul>
  <li><a href="index.php">Index Page</a></li>
        <li><a href="demo.php">Demonstration</a></li>
        <li><a href="resources.html">Resources</a></li>
        <li><a href="me.html">About me</a></li>
        <li><a href="create.php">Add Record</a></li>
        <li><a href="index.html">Home</a></li>
        <li><a href="about.html">About Museum</a></li>
        <li><a href="destinations.html">Destinations</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="contact.html">Contact Us</a></li>
    </ul>
  </nav>

    <style>
         .wrapper {
        width: 600px;
        margin: 0 auto;
    }
    ul {
list-style-type: circle;
margin: 10px;
padding: 14px;
overflow: hidden;
background-color: #7e7eb8;
font-size: 30px;
font-weight: bold;
border-style: solid;
border-color: #181853;
}

li {
float: left;
}

li a {
display: block;
color: #070732;
text-align: center;
padding: 10px 50px;
}

li a:hover:not(.active) {
background-color:#7f89f9;
}

.active {
background-color:#b03030;
}
        h1 {
              font-weight: bold;
              font-family: georgia;
              text-align: center;
              text-shadow: 1px 1px #efefb8;
              text-decoration: underline;
              color:#070732;
              font-size: 34px;
                }  
        h2{
            font-weight: bold; 
            text-align: center;
            font-family: serif;
            font-size: 30px; 
            color: #463185;
        } 
        p{
            text-align: center;
            font-family: serif;
            font-size: 20px; 
            color: black;
        } 
        img {
display: block;
margin: auto;
width: 30%;
border: 3px solid black;
} 
     label{
                font-family: serif;  
                text-align:center;
                font-size: 20px; 
                font-weight: bold;
            }
.btn {
    background-color:#463185; 
    color: white; 
    border: none;
    padding: 10px 20px;
    font-size: 20px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s ease;
}
.btn:hover {
    background-color: #7b64c0cf; 
}
    </style>
   
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="mt-5 mb-3">View Information</h1>
                    <div class="form-group">
                        <label>Flight Number</label>
                        <p><b><?php echo $row["FlightNumber"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Departure city</label>
                        <p><b><?php echo $row["DepartureCity"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Destination City</label>
                        <p><b><?php echo $row["DestinationCity"]; ?></b></p>
                    </div>
                    <div class="form-group">
                        <label>Departure Time</label>
                        <p><b><?php echo $row["DepartureTime"]; ?></b></p>
                    </div>
                    <p><a href="demo.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>
 <!-- Footer Section -->
 <footer>
 <p>&copy; 2023 Sagar Airlines. All Rights Reserved.</p>
  </footer>
</html>