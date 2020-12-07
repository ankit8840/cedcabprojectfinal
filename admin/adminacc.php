<?php
require 'class.php';
if (!empty(isset($_SESSION['userdata']) && ($_SESSION['userdata']['name'] == 'admin'))) {
    $user = $_SESSION['userdata']['name'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    echo "<script> window.location.href ='../login.php'</script>";
$id=$_SESSION['userdata']['userid'];
$name=$_SESSION['userdata']['name'];
$con = new showuser();
$con->connect('localhost', 'root', '', 'newtasks');
$loc=$con->useraccount($id);
if(isset($_POST['update'])){
    $name=$_POST['name1'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];
    $loc=$con->update($id,$name,$mobile,$password);
    if($loc){
    header("Refresh:0; url=logout.php");
    }
    $loc=$con->useraccount($id);
}
?>
<?php require 'adminnav.html'?>
<div id="tiles">
    <h1 style="color:white">Account Info</h1>
    <table id="tiletab">
    <tr>
        <td>Admin Id</td>
        <td>Admin Name</td>
        <td>Name</td>
        <td>Mobile</td>
        <td>Password</td>
        <td>Action</td>
    </tr>
     <?php foreach ($loc as $row) :?>
     <form method="POST">
        <tr>
            <td><?php echo $row['user_id']?><input id="userid" value=<?php echo $row['user_id']?> name="userid" size="2" hidden></td>
            <td><?php echo $row['user_name']?><input id="username" value=<?php echo $row['user_name']?> name="username" size="10" hidden></td>
            <td><?php echo $row['name']?><input id="name" type="text"  pattern="[A-Za-z]{1,}" value=<?php echo $row['name']?> name="name1" size="10" hidden></td>
            <td><?php echo $row['mobile']?><input type="text" id="mobile" pattern="[1-9]{1}[0-9]{9}" value=<?php echo $row['mobile']?> name="mobile" size="10" hidden></td>
            <td><input type="password" value=<?php echo $row['password']?> name="password" size="5" required></td>
            <td><input type="submit" value="UPDATE" name="update"></td>
        </tr>
    </form>
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
     </body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    document.getElementById("userid").readOnly = true; 
    document.getElementById("username").readOnly = true; 
    document.getElementById("name").readOnly = true; 
        $(function () {
            
            $("#mobile").keypress(function (e) {
                if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                    return false;
                }
            });
        });

    </script>
    <html>




