<?php
require 'class.php';
$con = new Location();
$con->connect('localhost', 'root', '', 'newtasks');
$loc=$con->select();
if(isset($_POST['update'])){
    $locid=$_POST['locid'];

    $locname = $_POST['locname'];
    $locdis = $_POST['locdis'];
    $ava = $_POST['locava'];
    $loc=$con->update($locid,$locname,$locdis,$ava);
    header("Refresh:0; url=showroute.php");
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
    <?php if ($loc->num_rows>0) :?>
     <?php while ($row = $loc->fetch_assoc()) :?>
     <form method="POST">
        <tr>
            <td><input type="text"  value=<?php echo $row['loc_id']?> name="locid" size="10" required id="locid"></td>
            <td><input type="text"  pattern="[A-Za-z]{1,}" value=<?php echo $row['loc_name']?> name="locname" size="10" required id="locname" ></td>
            <td><input type="number" value=<?php echo $row['loc_distance']?> name="locdis" size="10" required></td>
            <td><input type="number" value=<?php echo $row['is_available']?> name="locava" size="10" required></td>
            <td><input type="submit" value="UPDATE" name="update"></td>
            <td><input type="submit" value="DELETE" name="delete"></td>
        </tr>
    </form>
     <?php endwhile;?>
     <?php endif;?>
</table>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    document.getElementById("locid").readOnly = true; 
    </script>
