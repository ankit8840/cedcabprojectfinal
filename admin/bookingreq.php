<?php
require 'class.php';
if (!empty(isset($_SESSION['userdata']) && ($_SESSION['userdata']['name'] == 'admin'))) {
    $user = $_SESSION['userdata']['name'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    header("Refresh:0; url=../login.php");
}
$conn1 = new Riderequests();

$conn1->connect('localhost', 'root', '', 'newtasks');
if(isset($_REQUEST['Approved_id'])){
    $id=$_REQUEST['Approved_id'];
    $requst=$conn1->pending($id);
    header("Refresh:0; url=bookingreq.php");
}
if(isset($_REQUEST['complete_id'])){
    $id=$_REQUEST['complete_id'];
    // echo '<script>confirm("Do You want to Delete?")</script>';
    $requst=$conn1->cancle($id);
    header("Refresh:0; url=bookingreq.php");
}
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
    $requst=$conn1->sortname($sort,$order);
}
$requst=$conn1->ridereq($sort,$order);
?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">Pending Rides</h1>
    <div style="display:inline-block">
        <a href="#" id="sorta">Sort By</a>
            <div style="color:white;"class="sortby">
                <a style="color:red;text-decoration:none;cursor:pointer" id="date">Date</a>
                <a style="color:red;text-decoration:none;cursor:pointer" id="fare">Fare</a>
            </div>
            <div id="orderdate">
                <a style="color:red;text-decoration:none;" href="bookingreq.php?sort=ride_date&order=asc">Asscending</a>
                <a style="color:red;text-decoration:none;" href="bookingreq.php?sort=ride_date&order=desc">Descending</a>
            </div>
            <div id="orderfare">
                <a style="color:red;text-decoration:none;" href="bookingreq.php?sort=total_fare&order=asc">Asscending</a>
                <a style="color:red;text-decoration:none;" href="bookingreq.php?sort=total_fare&order=desc">Descending</a>
            </div>
    </div>
    <div>
        <a href="#" style="color:black;display:inline-block;float:left;padding:5px;">Filter By</a>
            <div class="sortby">
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="bookingreq.php?filter=day">Day</a>
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="bookingreq.php?filter=month">Month</a>
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="bookingreq.php?filter=year">Year</a>
                <a style="color:red;text-decoration:none;float:right;padding:5px;" href="bookingreq.php?clear=all">clear Filter</a>
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
            <td><a  style="color:red;text-decoration:none;"  onClick="javascript: return confirm('Please confirm deletion');" href="bookingreq.php?complete_id=<?php echo $row['ride_id']?>">Cancle</a></td>
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
</div>
<div id="addfoot">
        <a><i class="fa fa-facebook-square"></i></a>
        <a><i class="fa fa-twitter-square"></i></a>
        <a><i class="fa fa-instagram"></i></a>
        <div id="copyright">© 2020 Copyright:
            <a href="#">Cedcabs.com</a>
        </div>
</div>
</body>
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