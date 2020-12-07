<?php
require 'class.php';
if (!empty(isset($_SESSION['userdata']) && ($_SESSION['userdata']['name'] == 'admin'))) {
    $user = $_SESSION['userdata']['name'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    echo "<script> window.location.href ='../login.php'</script>";
}
$con = new Location();
$con->connect('localhost', 'root', '', 'newtasks');
$loc=$con->select();
if(isset($_POST['update'])){
    $locid=$_POST['locid'];

    $locname = $_POST['locname'];
    $locdis = $_POST['locdis'];
    $ava = $_POST['locava'];
    if($ava=="Yes"){
        $locava=1;
    }
    else{
    $locava=0;
    }
    $loc=$con->update($locid,$locname,$locdis,$locava);
    if($loc){
    echo '<script>alert("Updated")</script>';
    header("Refresh:0; url=showroute.php");
    }
}
if(isset($_POST['delete'])){
    $locid=$_POST['locid'];
    $loc=$con->delete($locid);
    header("Refresh:0; url=showroute.php");
}
?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">Location Routes</h1>
    <table id="tiletab">
    <tr>
        <td>Location Id</td>
        <td>Location Name</td>
        <td>Distance</td>
        <td>Available</td>
        <td>Action</td>
        <td>Action</td>
    </tr>
    <?php if(isset($loc)):?>
        <?php foreach ($loc as $row) :?>
     <form method="POST">
        <tr>
            <td><?php echo $row['loc_id']?><input type="text"  value=<?php echo $row['loc_id']?> name="locid" size="10" required id="locid" hidden></td>
            <td><input type="text"  pattern="[a-zA-Z0-9\s]+" value=<?php echo $row['loc_name']?> name="locname" size="10" required id="locname" ></td>
            <td><input type="number" min=0 value=<?php echo $row['loc_distance']?> name="locdis" size="10" required></td>
            <?php if($row['is_available']==1){
                $avalb="Yes";
            }
                else{
                $avalb="No";
                }
                ?>
            <td><select id="cars" name="locava" value="<?php echo $avalb ?>">
                <option><?php echo $avalb ?></option>
                <option value="Yes">Yes</option>
                <option value="No">No</option></select></td>
            <td><input type="submit" value="UPDATE" name="update"></td>
            <td><input type="submit" onClick="javascript: return confirm('Please confirm deletion');" value="DELETE" name="delete"></td>
        </tr>
    </form>
    <?php endforeach;?>
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
    document.getElementById("locid").readOnly = true; 
    </script>
