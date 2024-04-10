<?php
// Process delete operation after confirmation
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Include config file
    require_once "config.php";

    // Prepare a delete statement
    $sql = "DELETE FROM flights WHERE id = ?"; 

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Bind variables to the prepared statement as parameters
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // Set parameters
        $param_id = trim($_POST["id"]);

        // Attempt to execute the prepared statement
        if (mysqli_stmt_execute($stmt)) {
            // Informations deleted successfully. Redirect to landing page
            header("location: index.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    mysqli_stmt_close($stmt);

    // Close connection
    mysqli_close($link);
} else {
    // Check existence of id parameter
    if (empty(trim($_GET["id"]))) {
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
    <title>Delete Information</title>
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
.btn {
    background-color:#070732; 
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
      <img src="Images/call.jpeg" alt="planes",</img>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5 mb-3">Delete Information</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="alert alert-danger">
                            <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>" />
                            <p>Are you sure you want to delete this Flight Information?</p>
                            <p>
                                <input type="submit" value="Yes" class="btn btn-danger">
                                <a href="demo.php" class="btn btn-secondary">No</a>
                            </p>
                        </div>
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