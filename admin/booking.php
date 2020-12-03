<?php
require 'class.php';
$conn1 = new Riderequests();
$id=$_SESSION["userdata"]["userid"];
$conn1->connect('localhost', 'root', '', 'newtasks');
if(isset($_REQUEST['sort'])){
    $sort=$_REQUEST['sort'];
    
}else{

$sort="ride_id";

}
$ride=$conn1->sortname($sort);
?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">All Rides</h1>
    <div >
        <a href="#" id="sorta">Sort By</a>
            <div style="color:white;"class="sortby">
                <a style="color:red;text-decoration:none;" href="booking.php?sort=pickup">Name</a>
                <a style="color:red;text-decoration:none;" href="booking.php?sort=ride_date">Date</a>
                <a style="color:red;text-decoration:none;" href="booking.php?sort=total_fare">Fare</a>
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
        </tr>
     <?php endwhile;?>
     <?php endif;?>
    </table>
</div>
<script>
    function req(){
        
    }
</script>

