<?php
require 'class.php';
$con = new Location();
$con->connect('localhost', 'root', '', 'newtasks');
$loc=$con->select();
if(isset($_POST['update'])){
    $locid=$_POST['locid'];
    $locname = $_POST['locname'];
    $locdis = $_POST['locdis'];
    $loc=$con->update($locid,$locname,$locdis);
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
            <td><input type="text" value=<?php echo $row['loc_id']?> name="locid" size="10"></td>
            <td><input type="text" value=<?php echo $row['loc_name']?> name="locname" size="10"></td>
            <td><input type="text" value=<?php echo $row['loc_distance']?> name="locdis" size="10"></td>
            <td><input type="text" value=<?php echo $row['is_available']?> name="locdis" size="10"></td>
            <td><input type="submit" value="UPDATE" name="update"></td>
            <td><input type="submit" value="DELETE" name="delete"></td>
        </tr>
    </form>
     <?php endwhile;?>
     <?php endif;?>
</table>
