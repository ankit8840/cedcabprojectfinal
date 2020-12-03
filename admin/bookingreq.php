<?php
require 'class.php';
$conn1 = new Riderequests();

$conn1->connect('localhost', 'root', '', 'newtasks');
$requst=$conn1->ridereq();
if(isset($_REQUEST['Approved_id'])){
    $id=$_REQUEST['Approved_id'];
    $requst=$conn1->pending($id);
    header("Refresh:0; url=bookingreq.php");
}
if(isset($_REQUEST['complete_id'])){
    $id=$_REQUEST['complete_id'];
    $requst=$conn1->cancle($id);
    header("Refresh:0; url=bookingreq.php");
}
?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">Pending Rides</h1>
    <table id="tiletab">
    <tr>
        <td>RideID</td>
        <td>Ride_Date</td>
        <td>Pickup</td>
        <td>Drop</td>
        <td>Distance</td>
        <td>Luggage</td>
        <td>Fare</td>
        <td>Action</td>
        <td>Action</td>
    </tr>
    <?php if ($requst->num_rows>0) :?>
     <?php while ($row = $requst->fetch_assoc()) :?>
        
        <tr>
            <td><?php echo $row['ride_id']?></td>
            <td><?php echo $row['ride_date']?></td>
            <td><?php echo $row['pickup']?></td>
            <td><?php echo $row['droploc']?></td>
            <td><?php echo $row['total_distance']?></td>
            <td><?php echo $row['luggage']?></td>
            <td><?php echo $row['total_fare']?></td>
            <td><a  style="color:red;text-decoration:none;" href="bookingreq.php?complete_id=<?php echo $row['ride_id']?>">Cancle</a></td>
            <td><a style="color:red;text-decoration:none;" id="pending" href="bookingreq.php?<?php if($row['status']==1){
                                                            echo "Approved";
                                                            }else
                                            echo "completed";?>_id=<?php echo $row['ride_id']?>"><?php if ($row['status']==2){
                echo "complete";
            }else{
                echo "Approved";
            }?></td>
        </tr>
     <?php endwhile;?>
     <?php endif;?>
</table>
</html>