<?php
require 'class.php';
if (!empty(isset($_SESSION['userdata']) && ($_SESSION['userdata']['name'] == 'admin'))) {
    $user = $_SESSION['userdata']['name'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    echo "<script> window.location.href ='../login.php'</script>";
$conn1 = new Riderequests();
$id=$_SESSION["userdata"]["userid"];
$conn1->connect('localhost', 'root', '', 'newtasks');
if(isset($_REQUEST['sort']) && isset($_REQUEST['order'])){
    $sort=$_REQUEST['sort'];
    $order=$_REQUEST['order'];
}
else{

    $sort="ride_id";
    $order="asc";
    }
if(isset($_REQUEST['filter'])){
    $sort=$_REQUEST['filter'];
    $order="asc";
}
if(isset($_REQUEST['clear'])){
    $ride=$conn1->sortname($sort,$order);
}
$ride=$conn1->sortname($sort,$order);
?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">All Rides</h1>
    <div style="display:inline-block">
        <a href="#" id="sorta">Sort By</a>
            <div style="color:white;"class="sortby">
                <a style="color:red;text-decoration:none;cursor:pointer" id="date">Date</a>
                <a style="color:red;text-decoration:none;cursor:pointer" id="fare">Fare</a>
            </div>
            <div id="orderdate">
                <a style="color:red;text-decoration:none;" href="booking.php?sort=ride_date&order=asc">Asscending</a>
                <a style="color:red;text-decoration:none;" href="booking.php?sort=ride_date&order=desc">Descending</a>
            </div>
            <div id="orderfare">
                <a style="color:red;text-decoration:none;" href="booking.php?sort=total_fare&order=asc">Asscending</a>
                <a style="color:red;text-decoration:none;" href="booking.php?sort=total_fare&order=desc">Descending</a>
            </div>
    </div>
    <div>
        <a href="#" style="color:black;display:inline-block;float:left;padding:5px;">Filter By</a>
            <div class="sortby">
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="booking.php?filter=day">Day</a>
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="booking.php?filter=month">Month</a>
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="booking.php?filter=year">Year</a>
                <a style="color:red;text-decoration:none;float:right;padding:5px;" href="booking.php?clear=all">clear Filter</a>
            </div>
        
    </div>
   
    <table id="usertbl">
    <tr>
        <td>RideID</td>
        <td>Ride_Date</td>
        <td>Pickup</td>
        <td>Drop</td>
        <td>Distance</td>
        <td>Luggage</td>
        <td>Fare</td>
    </tr>
    <?php if(isset($ride)):?>
    <?php foreach ($ride as $row) :?>
        
        <tr>
            <td><?php echo $row['ride_id']?></td>
            <td><?php echo $row['ride_date']?></td>
            <td><?php echo $row['pickup']?></td>
            <td><?php echo $row['droploc']?></td>
            <td><?php echo $row['total_distance'] ." Km "?></td>
            <td><?php echo $row['luggage']." Kg "?></td>
            <td><?php echo "₹". $row['total_fare']?></td>
        </tr>
    <?php endforeach;?>
    <?php endif;?>
    </table>
</div>
<div id="addfoot" style="margin-top:1150px;">
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

