<?php
require 'class.php';
if (!empty(isset($_SESSION['userdata']) && ($_SESSION['userdata']['name'] == 'admin'))) {
    $user = $_SESSION['userdata']['name'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    header("Refresh:0; url=../login.php");
}
$conn1 = new Riderequests();
$id=$_SESSION["userdata"]["userid"];
$conn1->connect('localhost', 'root', '', 'newtasks');
if(isset($_REQUEST['filter'])){
    $sort=$_REQUEST['filter'];
    
}else{

$sort="ride_id";

}
$ride=$conn1->completerides($sort);
?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">Complete Rides</h1>
    <div >
        <a href="#" style="color:white;">Filter By</a>
            <div class="sortby">
                <a  style="color:red;text-decoration:none;" href="completerides.php?filter=day">Day</a>
                <a  style="color:red;text-decoration:none;" href="completerides.php?filter=month">Month</a>
                <a  style="color:red;text-decoration:none;" href="completerides.php?filter=year">Year</a>
            </div>
    </div>
    <table id="tiletab">
    <tr>
        <td>RideID</td>
        <td>Ride_Date</td>
        <td>Pickup</td>
        <td>Drop</td>
        <td>Distance</td>
        <td>Luggage</td>
        <td>Fare</td>
        <td>Status</td>
        <td>Action</td>
    </tr>
    <?php if ($ride->num_rows>0) :?>
     <?php while ($row = $ride->fetch_assoc()) :?>
        
        <tr>
            <td><?php echo $row['ride_id']?></td>
            <td><?php echo $row['ride_date']?></td>
            <td><?php echo $row['pickup']?></td>
            <td><?php echo $row['droploc']?></td>
            <td><?php echo $row['total_distance']?></td>
            <td><?php echo $row['luggage']?></td>
            <td><?php echo $row['total_fare']?></td>
            <td>Completed</td>
            <td><a style="color:red;text-decoration:none;" href="userinvoice.php?rideid=<?php echo $row['ride_id']?>">Invoice</a></td>
        </tr>
     <?php endwhile;?>
     <?php endif;?>
    </table>
</div>
<div id="addfoot">
        <a><i class="fa fa-facebook-square"></i></a>
        <a><i class="fa fa-twitter-square"></i></a>
        <a><i class="fa fa-instagram"></i></a>
        <div id="copyright">© 2020 Copyright:
            <a href="#">Cedcabs.com</a>
        </div>
</div>
<script>
    function req(){
        
    }
</script>

