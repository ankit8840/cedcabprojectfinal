<?php
require 'class.php';
$conn1 = new Riderequests();

$conn1->connect('localhost', 'root', '', 'newtasks');
$requst=$conn1->ridereq();
if(isset($_REQUEST['pending_id'])){
    $id=$_REQUEST['pending_id'];
    $requst=$conn1->pending($id);
    header("Refresh:0; url=pendingrides.php");
}
if(isset($_REQUEST['complete_id'])){
    $id=$_REQUEST['complete_id'];
    $requst=$conn1->cancle($id);
    header("Refresh:0; url=pendingrides.php");
}
?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">Pending Ride Request</h1>
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
    <?php if(isset($ride)):?>
    <?php foreach ($ride as $row) :?>
        
        <tr>
            <td><?php echo $row['ride_id']?></td>
            <td><?php echo $row['ride_date']?></td>
            <td><?php echo $row['pickup']?></td>
            <td><?php echo $row['droploc']?></td>
            <td><?php echo $row['total_distance']?></td>
            <td><?php echo $row['luggage']?></td>
            <td><?php echo $row['total_fare']?></td>
            <td><a href="pendingrides.php?complete_id=<?php echo $row['ride_id']?>">Cancle</a></td>
            <td><a  id="pending" href="pendingrides.php?<?php if($row['status']==1){
                                                            echo "pending";
                                                            }else
                                            echo "completed";?>_id=<?php echo $row['ride_id']?>"><?php if ($row['status']==2){
                echo "complete";
            }else{
                echo "pending";
            }?></td>
        </tr>
        <?php endif;?>
     <?php endforeach;?>
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
</html>