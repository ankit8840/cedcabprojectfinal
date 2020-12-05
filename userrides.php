<?php 
require 'admin/class.php';
$name=$_SESSION["userdata"]["name"];
$conn1 = new userrides();
$id=$_SESSION["userdata"]["userid"];
$conn1->connect('localhost', 'root', '', 'newtasks');
if(isset($_REQUEST['sort']) && isset($_REQUEST['order'])){
    $sort=$_REQUEST['sort'];
    $order=$_REQUEST['order'];
    $id=$_SESSION["userdata"]["userid"];
}
else{

    $sort="user_id";
    $order="asc";
    $id=$_SESSION["userdata"]["userid"];
    }
if(isset($_REQUEST['filter'])){
    $sort=$_REQUEST['filter'];
    $order="asc";
    $id=$_SESSION["userdata"]["userid"];
}
if(isset($_REQUEST['clear'])){
    $requst=$conn1->ride($sort,$order,$id);
}
$requst=$conn1->ride($sort,$order,$id);
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
<?php

?>
<div id="tiles">
<div id="ridereq">
    <h1 style="color:white">All Rides</h1>
    <div style="display:inline-block">
        <a href="#" id="sorta">Sort By</a>
            <div style="color:white;"class="sortby">
                <a style="color:red;text-decoration:none;cursor:pointer" id="date">Date</a>
                <a style="color:red;text-decoration:none;cursor:pointer" id="fare">Name</a>
            </div>
            <div id="orderdate">
                <a style="color:red;text-decoration:none;" href="userrides.php?sort=ride_date&order=asc">Asscending</a>
                <a style="color:red;text-decoration:none;" href="userrides.php?sort=ride_date&order=desc">Descending</a>
            </div>
            <div id="orderfare">
                <a style="color:red;text-decoration:none;" href="userrides.php?sort=total_fare&order=asc">Asscending</a>
                <a style="color:red;text-decoration:none;" href="userrides.php?sort=total_fare&order=desc">Descending</a>
            </div>
    </div>
    <div>
        <a href="#" style="color:black;display:inline-block;float:left;padding:5px;">Filter By</a>
            <div class="sortby">
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="userrides.php?filter=day">Day</a>
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="userrides.php?filter=month">Month</a>
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="userrides.php?filter=year">Year</a>
                <a style="color:red;text-decoration:none;float:right;padding:5px;" href="userrides.php?clear=all">clear Filter</a>
            </div>
        
    </div>
    <table id="tiletab" style="margin-left:50px;">
    <tr>
        <td>RideID</td>
        <td>Ride_Date</td>
        <td>Pickup</td>
        <td>Drop</td>
        <td>CarType</td>
        <td>Distance</td>
        <td>Luggage</td>
        <td>Fare</td>
    </tr>
    <?php if ($requst->num_rows>0) :?>
     <?php while ($row = $requst->fetch_assoc()) :?>
        
        <tr>
            <td><?php echo $row['ride_id']?></td>
            <td><?php echo $row['ride_date']?></td>
            <td><?php echo $row['pickup']?></td>
            <td><?php echo $row['droploc']?></td>
            <td><?php echo $row['cartype']?></td>
            <td><?php echo $row['total_distance']?></td>
            <td><?php echo $row['luggage']?></td>
            <td><?php echo $row['total_fare']?></td>
        </tr>
     <?php endwhile;?>
     <?php endif;?>
</table>
</div>
</div>
<div id="addfoot">
        <a><i class="fa fa-facebook-square"></i></a>
        <a><i class="fa fa-twitter-square"></i></a>
        <a><i class="fa fa-instagram"></i></a>
        <div id="copyright">© 2020 Copyright:
            <a href="#">Cedcabs.com</a>
        </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(function () {
    $("#orderdate").hide();
    $("#orderfare").hide();
    $("#date").click(function(){
        $("#orderdate").show();
        $("#orderfare").hide();
    })
    $("#fare").click(function(){
        $("#orderfare").show();
        $("#orderdate").hide();
    })
    });
    </script>
</html>