<?php
require 'class.php';
$conn1 = new Riderequests();
$name=$_SESSION["userdata"]["name"];
$conn1->connect('localhost', 'root', '', 'newtasks');
$rideid=$_GET["rideid"];
$ride=$conn1->userinvoice($rideid);
?>
<!DOCTYPE html>
<html>
<head>
   <title>
      User Panel
   </title>
    <link rel="stylesheet" type="text/css" href="login.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="nav1">
        <ul>
            <li><img src="olaimg.png"></li>
            <div id="nav2">
                <h1>Welcome <?php echo $name ?></h1>
            </div>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div id="tiles">
    <?php if ($ride->num_rows>0) :?>
     <?php while ($row = $ride->fetch_assoc()) :?>
        
        <div id="invoice">
            <h1 style="color:black;">User Invoice</h1>
            <div>
                <label>Name:-   </label><span><?php echo $name ?></span>
            </div>
            <div>
                <label>Pickup Point:-   </label><span><?php echo $row['pickup'] ?></span>
            </div>
            <div>
                <label>Drop Point:-   </label><span><?php  echo $row['droploc'] ?></span>
            </div>
            <div>
                <label>Total Distance:-  </label><span><?php  echo $row['total_distance'] ?></span>
            </div>
            <div>
                <label>Luggage:-  </label><span><?php  echo $row['luggage'] ?></span>
            </div>
            <div>
                <label>Total Fare:-  </label><span><?php  echo $row['total_fare'] ?></span>
            </div>
            <div>
                <label>Date:-  </label><span><?php  echo $row['ride_date'] ?></span>
            </div>
           
        <div>
        <button  id="download" onclick="window.print()">Print</button>
     <?php endwhile;?>
     <?php endif;?>
    </table>
</div>
</body>
</html>
