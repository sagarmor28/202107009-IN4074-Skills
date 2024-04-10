<?php
// Include config file
require_once "config.php"; 

// Define variables and initialize with empty values
$FlightNumber = $DepartureCity = $DestinationCity = $DepartureTime = "";
$FlightNumber_err = $DepartureCity_err = $DestinationCity_err = $DepartureTime_err = "";


// Processing form data when form is submitted
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Get hidden input value
    $id = $_POST["id"];

     // Validate Flight number
     $input_FlightNumber = trim($_POST["FlightNumber"]);
     if (empty($input_FlightNumber)) {
         $FlightNumber_err = "Please enter the Flight number.";
     } else {
         $FlightNumber = $input_FlightNumber;
     }

    // Validate Departure city
    $input_DepartureCity = trim($_POST["DepartureCity"]);
    if (empty($input_DepartureCity)) {
        $DepartureCity_err = "Please enter a Departure city.";
    } else {
        $DepartureCity = $input_DepartureCity;
    }

    // Validate Destination city
    $input_DestinationCity = trim($_POST["DestinationCity"]);
    if (empty($input_DestinationCity)) {
        $DestinationCity_err = "Please enter an destination city.";
    } else {
        $DestinationCity = $input_DestinationCity;
    }

    // Validate Departure time
    $input_DepartureTime = trim($_POST["DepartureTime"]);
    if (empty($input_DepartureTime)) {
        $DepartureTime_err = "Please enter the Departure time.";
    } else {
        $DepartureTime = $input_DepartureTime;
    }

    // Check input errors before inserting in database
    if (empty($FlightNumber_err) && empty($DepartureCity_err) && empty($DestinationCity_err) && empty($DepartureTime_err)) {
        // Prepare an update statement
$sql = "UPDATE flights SET FlightNumber=?, DepartureCity=?, DestinationCity=?, DepartureTime=? WHERE id=?";

if ($stmt = mysqli_prepare($link, $sql)) {
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "ssssi", $param_FlightNumber, $param_DepartureCity, $param_DestinationCity, $param_DepartureTime, $param_id);

    // Set parameters
    $param_FlightNumber = $FlightNumber;
    $param_DepartureCity = $DepartureCity;
    $param_DestinationCity = $DestinationCity;
    $param_DepartureTime = $DepartureTime;
    $param_id = $id;

    // Attempt to execute the prepared statement
    if (mysqli_stmt_execute($stmt)) {
        // Records updated successfully. Redirect to landing page
        header("location: index.php");
        exit();
    } else {
        echo "Oops! Something went wrong. Please try again later.";
    }
}

        // Close statement
        mysqli_stmt_close($stmt);
    }

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter before processing further
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id =  trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM flights WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            // Set parameters
            $param_id = $id;

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
                    // URL doesn't contain valid id. Redirect to error page
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Information</title>
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
</style>
      <img src="Images/planes.jpeg" alt="flights",</img>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Update Information</h2>
                    <p>Please edit the input values and submit to update the flights information.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group">
                            <label>Flight number</label>
                            <input type="text" name="FlightNumber" class="form-control <?php echo (!empty($FlightNumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $FlightNumber; ?>">
                            <span class="invalid-feedback"><?php echo $FlightNumber_err; ?></span>
                        </div>   
                    <div class="form-group">
                            <label>Departure city</label>
                            <input type="text" name="DepartureCity" class="form-control <?php echo (!empty($DepartureCity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $DepartureCity; ?>">
                            <span class="invalid-feedback"><?php echo $DepartureCity_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Destination city</label>
                            <input type="text" name="DestinationCity" class="form-control <?php echo (!empty($DestinationCity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $DestinationCity; ?>">
                            <span class="invalid-feedback"><?php echo $DestinationCity_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Departure time</label>
                            <input type="text" name="DepartureTime" class="form-control <?php echo (!empty($DepartureTime_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $DepartureTime; ?>">
                            <span class="invalid-feedback"><?php echo $DepartureTime_err; ?></span>
                        </div>
                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="demo.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
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
