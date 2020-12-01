<?php
require 'class.php';
$conn1 = new Ride();

$conn1->connect('localhost', 'root', '', 'newtasks');
$ride=$conn1->select();
if(isset($_REQUEST['rn'])){
    $id=$_REQUEST['rn'];
    $requst=$conn1->accept($id);
    header("Refresh:0; url=ride.php");
}
if(isset($_REQUEST['gn'])){
    $id=$_REQUEST['gn'];
    $requst=$conn1->cancle($id);
    header("Refresh:0; url=ride.php");
}
?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">All Users</h1>
    <table>
        <tr>
            <td>UserID</td>
            <td>User Name</td>
            <td>Name</td>
            <td>Date</td>
            <td>Mobile</td>
            <td>Status</td>
            <!-- <td>Action</td>
            <td>Action</td> -->
        </tr>
        <?php if ($ride->num_rows>0) :?>
        <?php while ($row = $ride->fetch_assoc()) :?>
            
            <tr>
                <td><?php echo $row['user_id']?></td>
                <td><?php echo $row['user_name']?></td>
                <td><?php echo $row['name']?></td>
                <td><?php echo $row['date']?></td>
                <td><?php echo $row['mobile']?></td>
                <td><?php if($row['isblock']==1){
                    echo "Approved";
                    }
                 else echo "Pending";?>
            </td>
                <!-- <td><a href="ride.php?rn=<?php echo $row['user_id']?>">Approved</a></td>
                <td><a href="ride.php?gn=<?php echo $row['user_id']?>">Cancle</a></td> -->
            </tr>
        <?php endwhile;?>
        <?php endif;?>
    </table>
</div>
<script>
    function req(){
        
    }
</script>

