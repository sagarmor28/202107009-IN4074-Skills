<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$flightnumber = $departurecity = $destinationcity = $departuretime = "";
$flightnumber_err = $departurecity_err = $destinationcity_err = $departuretime_err = "";

// Processing form data when form is submitted  
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    // Validate flightnumber
    $input_flightnumber = trim($_POST["flightnumber"]);
    if (empty($input_flightnumber)) {
        $flightnumber_err = "Please enter Artwork Title.";
    } else {
        $flightnumber = $input_flightnumber;
    }

    // Validate Departure city
    $input_departurecity = trim($_POST["artistname"]);
    if (empty($input_departurecity)) {
        $departurecity_err = "Please enter Departure city.";
    } else {
        $departurecity = $input_departurecity; // Fixed variable assignment
    }

    // Validate Destination city
    $input_destinationcity = trim($_POST["destinationcity"]); // Corrected form field name
    if (empty($input_destinationcity)) {
        $destinationcity_err = "Please enter Destination city.";
    } else {
        $destinationcity = $input_destinationcity;
    }

    // Validate Departure time
    $input_departuretime = trim($_POST["departuretime"]);
    if (empty($input_departuretime)) {
        $departuretime_err = "Please enter the Departure time.";
    } else {
        $departuretime = $input_departuretime;
    }

    // Check input errors before inserting in database
    if (empty($flightnumber_err) && empty($departurecity_err) && empty($destinationcity_err) && empty($departuretime_err)) { // Fixed condition
        // Prepare an insert statement
        $sql = "INSERT INTO flights (flightnumber, departurecity, destinationcity, departuretime) VALUES (?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssss", $param_flightnumber, $param_departurecity, $param_destinationcity, $param_departuretime); // Fixed parameter types

            // Set parameters
            $param_flightnumber = $flightnumber;
            $param_departurecity = $departurecity;
            $param_destinationcity = $destinationcity;
            $param_departuretime = $departuretime;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Informations created successfully. Redirect to landing page
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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Information</title>
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
        label{
            text-align: center;
            font-family: serif;
            font-size: 20px; 
            color: black;
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
        img {
display: block;
margin: auto;
width: 30%;
border: 3px solid black;
} 
</style>
      <img src="Images/destination.jpeg" alt="flight",</img>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Create Information</h2>
                    <p>Please fill this form and submit to add Flights Information to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Flight number</label>
                            <input type="text" name="flightnumber" class="form-control <?php echo (!empty($flightnumber_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $flightnumber; ?>">
                            <span class="invalid-feedback"><?php echo $flightnumber_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Departure city</label>
                            <input type="text" name="artistname" class="form-control <?php echo (!empty($departurecity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $departurecity; ?>">
                            <span class="invalid-feedback"><?php echo $departurecity_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Destination city</label>
                            <input type="text" name="destinationcity" class="form-control <?php echo (!empty($destinationcity_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $destinationcity; ?>">
                            <span class="invalid-feedback"><?php echo $destinationcity_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Departure time</label>
                            <input type="text" name="departuretime" class="form-control <?php echo (!empty($departuretime_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $departuretime; ?>">
                            <span class="invalid-feedback"><?php echo $departuretime_err; ?></span>
                        </div>
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