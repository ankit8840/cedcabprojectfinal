<?php 
require 'class.php';
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
                        <input type="text" name="routename" required>
                    </label>
                </p>
                <p>
                    <label for="password">Distance: 
                        <input type="text" name="distance" required>
                    </label>
                </p>
                <p class="submit">
                    <input type="submit" name="submit" value="Add Route">
                </p>
                
            </form>
    </div>
</div>
</body>
<script>
    function bookingpage(){
        alert("enter");
    }
    </script>
</html>
