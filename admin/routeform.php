<?php 
require 'class.php';
if (!empty(isset($_SESSION['userdata']) && ($_SESSION['userdata']['name'] == 'admin'))) {
    $user = $_SESSION['userdata']['name'];
} else {
    echo "<script>alert('Permission Denied')</script>";
    header("Refresh:0; url=../login.php");
}
$con = new Database();
$con->connect('localhost', 'root', '', 'newtasks');
$msg = '';
$error = array();
if (isset($_POST["submit"])) {
    $routename = $_POST['routename'];
    $distance = $_POST['distance'];
   
    // if ($password!=$repassword) {
    //     $error=array('input'=>'password','msg'=>'password doesnt match');
    // }
    if (sizeof($error) == 0) {
        $fields = array('loc_name', 'loc_distance');
        $values = array($routename, $distance);

        $res = $con->insert($fields, $values, 'tbl_location');

        if ($res) {
            echo "<script>alert('inserted')</script>";
            $error=array('input'=>'form','msg'=>"1 Row inserted");
        }
    }
}?>
<?php require 'adminnav.html'?>
<div>
    <h1 style="color:white;text-align:center;">Add New Routes</h1>
    <div id="route-form">
          <h2>Add New Route</h2>
            <form action="" method="POST">
                <p>
                    <label for="username">RouteName: 
                        <input type="text" name="routename"  pattern="[a-zA-Z0-9\s]+" required>
                    </label>
                </p>
                <p>
                    <label for="password">Distance: 
                        <input type="number" name="distance" required>
                    </label>
                </p>
                <p class="submit">
                    <input type="submit" name="submit" value="Add Route">
                </p>
                
            </form>
    </div>
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
<script>
    function bookingpage(){
        alert("enter");
    }
    </script>
</html>
