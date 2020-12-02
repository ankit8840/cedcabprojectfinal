<?php require 'class.php';
$conn1 = new Totals();
$sum=0;
$conn1->connect('localhost', 'root', '', 'newtasks');
$users=$conn1->totalusers();
$ride=$conn1->totalrides();
$ridereq=$conn1->totalridesrequest();
$userreq=$conn1->totalusersrequest();
$location=$conn1->totallocations();
$totalearn=$conn1->totalearn();
if ($totalearn->num_rows>0) {
    $sum=0;
    while ($row = $totalearn->fetch_assoc()){
        $sum +=$row['total_fare'];
    }
}


?>
<?php require 'adminnav.html'?>
<div id="tiles">
<div class="tile"><br>
<a href="ride.php"><i class="fa fa-th-large" style="font-size:36px;"></i><br><span class="count"><?php echo $users?></span><br>All Users</a></div>
<div class="tile"><br>
<a  href="booking.php"><i class="fa fa-automobile" style="font-size:36px;"></i><br><br><span class="count"><?php echo $ride?></span><br>Total Rides</a></div>
<div class="tile">
<a href="pendinguser.php"><i class="fa fa-address-book" style="font-size:36px"></i><br><br><span class="count"><?php echo $userreq?></span><br>Pending user Request</a></div>
<div class="tile">
<a href="pendingrides.php"><i class="fa fa-bell" style="font-size:36px"></i><br><br><span class="count"><?php echo $ridereq?></span><br>Pending Ride Request</a></div>
<div class="tile">
<a href="showroute.php"><i class="fa fa-map-marker" style="font-size:36px"></i><br><br><span class="count"><?php echo $location?></span><br>Total Location</div>
<div class="tile">
<a><i class="fa fa-hourglass-1" style="font-size:36px"></i><br><br><span class="count"><?php echo $sum?></span><br>Total Earning</a></div>
</div>


</html>