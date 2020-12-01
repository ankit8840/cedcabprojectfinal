<?php
require 'class.php';
$conn1 = new showuser();

$conn1->connect('localhost', 'root', '', 'newtasks');
$requst=$conn1->usertable();
if(isset($_REQUEST['blocked_id'])){
    $id=$_REQUEST['blocked_id'];
    $requst=$conn1->blocked($id);
    header("Refresh:0; url=user.php");
}
if(isset($_REQUEST['unblocked_id'])){
    $id=$_REQUEST['unblocked_id'];
    $requst=$conn1->unblocked($id);
    header("Refresh:0; url=user.php");
}
if(isset($_REQUEST['gn'])){
    $id=$_REQUEST['gn'];
    $requst=$conn1->cancle($id);
    header("Refresh:0; url=user.php");
}
?>
<?php require 'header.html'?>
<table id="usertbl">
    <tr>
        <td>UserID</td>
        <td>User Name</td>
        <td>Name</td>
        <td>Date</td>
        <td>Mobile</td>
        <td>Status</td>
        <td>Action</td>
        <td>Action</td>
    </tr>
    <?php if ($requst->num_rows>0) :?>
     <?php while ($row = $requst->fetch_assoc()) :?>
        
        <tr>
            <td><?php echo $row['user_id']?></td>
            <td><?php echo $row['user_name']?></td>
            <td><?php echo $row['name']?></td>
            <td><?php echo $row['date']?></td>
            <td><?php echo $row['mobile']?></td>
            <td><?php if($row['isblock']==1){
                echo "Unblocked";
            }else{
                echo "Blocked";
            }?></td>
            <td><a  id="blocked" href="user.php?<?php if($row['isblock']==0){
                                                            echo "blocked";
                                                            }else
                                            echo "unblocked";?>_id=<?php echo $row['user_id']?>"><?php if ($row['isblock']==0){
                echo "unblock";
            }else{
                echo "blocked";
            }?></td>
            <td><a href="user.php?gn=<?php echo $row['user_id']?>">Delete</a></td>
        </tr>
     <?php endwhile;?>
     <?php endif;?>
</table>