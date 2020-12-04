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
$ride=$conn1->approveduser();

?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">Approved User Request</h1>
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
<script>
    function req(){
        
    }
</script>

