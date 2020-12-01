<?php
require 'class.php';
$conn1 = new Riderequests();

$conn1->connect('localhost', 'root', '', 'newtasks');
$ride=$conn1->canclerides();
// if(isset($_REQUEST['rn'])){
//     $id=$_REQUEST['rn'];
//     $requst=$conn1->accept($id);
//     header("Refresh:0; url=ride.php");
// }
// if(isset($_REQUEST['gn'])){
//     $id=$_REQUEST['gn'];
//     $requst=$conn1->cancle($id);
//     header("Refresh:0; url=ride.php");
// }
?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">Cancle Rides</h1>
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
            <td>Canclled</td>
        </tr>
     <?php endwhile;?>
     <?php endif;?>
    </table>
</div>
<script>
    function req(){
        
    }
</script>

