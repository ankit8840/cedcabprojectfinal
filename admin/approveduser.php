<?php
require 'class.php';
if (!empty(isset($_SESSION['userdata']) && ($_SESSION['userdata']['name'] == 'admin'))) {
    $user = $_SESSION['userdata']['name'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    header("Refresh:0; url=../login.php");
}
$conn1 = new Ride();

$conn1->connect('localhost', 'root', '', 'newtasks');
if(isset($_REQUEST['sort']) && isset($_REQUEST['order'])){
    $sort=$_REQUEST['sort'];
    $order=$_REQUEST['order'];
}
else{

    $sort="user_id";
    $order="asc";
    }
if(isset($_REQUEST['filter'])){
    $sort=$_REQUEST['filter'];
    $order="asc";
}
if(isset($_REQUEST['clear'])){
    $ride=$conn1->approveduser($sort,$order);
}
$ride=$conn1->approveduser($sort,$order);

?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">Approved User Request</h1>
    <div style="display:inline-block">
        <a href="#" id="sorta">Sort By</a>
            <div style="color:white;"class="sortby">
                <a style="color:red;text-decoration:none;cursor:pointer" id="date">Date</a>
                <a style="color:red;text-decoration:none;cursor:pointer" id="fare">Name</a>
            </div>
            <div id="orderdate">
                <a style="color:red;text-decoration:none;" href="approveduser.php?sort=date&order=asc">Asscending</a>
                <a style="color:red;text-decoration:none;" href="approveduser.php?sort=date&order=desc">Descending</a>
            </div>
            <div id="orderfare">
                <a style="color:red;text-decoration:none;" href="approveduser.php?sort=name&order=asc">Asscending</a>
                <a style="color:red;text-decoration:none;" href="approveduser.php?sort=name&order=desc">Descending</a>
            </div>
    </div>
    <div>
        <a href="#" style="color:black;display:inline-block;float:left;padding:5px;">Filter By</a>
            <div class="sortby">
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="approveduser.php?filter=day">Day</a>
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="approveduser.php?filter=month">Month</a>
                <a  style="color:red;text-decoration:none;float:left;padding:5px;" href="approveduser.php?filter=year">Year</a>
                <a style="color:red;text-decoration:none;float:right;padding:5px;" href="approveduser.php?clear=all">clear Filter</a>
            </div>
        
    </div>
    <table style="margin-left:50px;">
        <tr>
            <td>UserID</td>
            <td>User Name</td>
            <td>Name</td>
            <td>Date</td>
            <td>Mobile</td>
        </tr>
        <?php if ($ride->num_rows>0) :?>
        <?php while ($row = $ride->fetch_assoc()) :?>
            
            <tr>
                <td><?php echo $row['user_id']?></td>
                <td><?php echo $row['user_name']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['date']?></td>
                <td><?php echo $row['mobile']?></td>
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

