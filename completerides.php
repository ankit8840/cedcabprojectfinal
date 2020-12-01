<?php
require 'class.php';
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
        <a href="#"  style="color:white" id="sorta">Filter By</a>
            <div class="sortby">
                <a href="completerides.php?filter=day">Day</a>
                <a href="completerides.php?filter=month">Month</a>
                <a href="completerides.php?filter=year">Year</a>
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
            <td><a href="userinvoice.php?rideid=<?php echo $row['ride_id']?>?userid=<?php echo $row['customer_user_id']?>">Invoice</a></td>
        </tr>
     <?php endwhile;?>
     <?php endif;?>
    </table>
</div>
<script>
    function req(){
        
    }
</script>

