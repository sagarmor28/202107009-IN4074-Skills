<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Flights</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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
    <img src="Images/booking.jpeg" alt="flights",</img>

    <script>
        $(document).ready(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Flight Information</h2>
                        <a href="create.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Add New Information</a>
                    </div>
                    <?php
                    // Include config file
                    require_once "config.php";

                    // Attempt select query execution 
                    $sql = "SELECT * FROM flights";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo '<table class="table table-bordered table-striped">';
                            echo "<thead>";
                            echo "<tr>";
                            echo "<th>id</th>";
                            echo "<th>FlightNumber</th>";
                            echo "<th>DepartureCity</th>";
                            echo "<th>DestinationCity</th>";
                            echo "<th>DepartureTime</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['FlightNumber'] . "</td>";
                                echo "<td>" . $row['DepartureCity'] . "</td>";
                                echo "<td>" . $row['DestinationCity'] . "</td>";
                                echo "<td>" . $row['DepartureTime'] . "</td>";
                                echo "<td>";
                                echo '<a href="read.php?id=' . $row['id'] . '" class="mr-3" title="View Information" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                echo '<a href="update.php?id=' . $row['id'] . '" class="mr-3" title="Update Information" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                echo '<a href="delete.php?id=' . $row['id'] . '" title="Delete Information" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else {
                            echo '<div class="alert alert-danger"><em>No information were found.</em></div>';
                        }
                    } else {
                        echo "Oops! Something went wrong. Please try again later.";
                    }

                    // Close connection
                    mysqli_close($link);
                    ?>
                </div>
            </div>
        </div>
    </div>
  <!-- Footer Section -->
  <footer>
    <p>&copy; 2023 Sagar Airlines. All Rights Reserved.</p>
  </footer>