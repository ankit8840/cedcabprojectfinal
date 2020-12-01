<?php require 'class.php';
    $pickup=$_SESSION['invoice']['pickup'];
    $drop=$_SESSION['invoice']['drop'];
    $distance=$_SESSION['invoice']['distance'];
    $luggage=$_SESSION['invoice']['luggage'];
    $fare=$_SESSION['invoice']['fare'];

?>
<!DOCTYPE html>
<html>
<head>
   <title>
      Admin Panel
   </title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="nav1">
        <ul>
            <li><img src="olaimg.png"></li>
        </ul>
<div id="aside">

<div class="sidenav">
  <a href="userdashboard.php">Home</a>
  <a href="index.php">Book New Ride</a>
  <a href="userpendingrides.php">Pending Rides</a>
  <a href="usercomplete.php">Completed Rides</a>
  <a href="usercanclerides.php">Canceled Rides</a>
  <a href="userrides.php">All Rides</a>
  <a href="useraccount.php">Account</a>
  <a href="logout.php">Logout</a>
</div> 
</div>
<?php

?>
    <div id="invoice">
        <h1>Your Request is Pending</h1>
        <div>
            <label>Pickup Point:-   </label><span><?php echo $pickup ?></span>
        </div>
        <div>
            <label>Drop Point:-   </label><span><?php echo $drop ?></span>
        </div>
        <div>
            <label>Total Distance:-  </label><span><?php echo $distance ?></span>
        </div>
        <div>
            <label>Luggage:-  </label><span><?php echo $luggage ?></span>
        </div>
        <div>
            <label>Total Fare:-  </label><span><?php echo $fare ?></span>
        </div>
    <div>
    
</body>
</html>
