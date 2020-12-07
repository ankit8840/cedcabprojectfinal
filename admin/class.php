<?php
session_start();
class Database
{
    public function connect($host, $user, $pass, $dtb) 
    {
        $this->serverame = $host;
        $this->username = $user;
        $this->password = $pass;
        $this->dbname   = $dtb;

        return $this->conn = mysqli_connect($host, $user, $pass, $dtb) or die('Could Not Connect.');
    }
    public function insert($fields, $data, $table) 
    {
        try {
            $queryFields = implode(",", $fields);

            $queryValues = implode('","', $data);
            
            $insert = 'INSERT INTO '.$table.'('.$queryFields.') VALUES ("'.$queryValues.'")';

            if (mysqli_query($this->conn, $insert)) {
                return true;
            } else {
                echo '<script>alert("Not Accept Duplicate data or Invalid data")</script>';
                //die(mysqli_error($this->conn));
            }
        } catch (Exception $ex) {
            echo "Some Exception Occured " . $ex;
        }
    }
    public function select() 
    {
        $result=mysqli_query($this->conn, "SELECT * FROM tbl_user");
        return $result;
    }
}
class User extends Database
{
   
    public function login($username,$password) 
    {
        $isblock=1;
        $sql ='SELECT * FROM tbl_user WHERE 
        `user_name`="'.$username.'" AND 
        `password`="'.$password.'" AND `isblock`="'.$isblock.'"';
        $result = $this->conn->query($sql);
        if ($result->num_rows>0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION["userdata"]=array('name' => $row['name'],
                'userid'=>$row['user_id'],'logintime'=>time());
            }
            // header("Refresh:0; url=../index.html");
        } else {
            $rtn = "Login Failed";
            return $rtn;
        }
      
    }
}
class Location extends Database
{
    public function select()
    {
        $sql='SELECT * FROM tbl_location';
        $result = $this->conn->query($sql);
        return $result;
    }
    public function update($locid,$locname,$locdis,$ava)
    {
        $sql = "UPDATE tbl_location SET `loc_name`='$locname',`loc_distance`='$locdis',`is_available`='$ava'
        WHERE `loc_id` = '$locid' ";
        $result = $this->conn->query($sql);
        return $result;
    }
    public function delete($id){
        $sql = "DELETE FROM tbl_location WHERE `loc_id`= '$id' ";
        $result = $this->conn->query($sql);
        return $result;
    }
}
class Ride extends Database
{
    public function selectall($sort,$order)
    {
       
        if(($order=="asc") && ($sort=='name'|| $sort=='date')){
            $sql="SELECT * FROM tbl_user WHERE `is_admin`='user'  ORDER BY  `$sort` asc ";
            $rides = $this->conn->query($sql);
            if(mysqli_num_rows($rides)){
                return $rides;
            }
            }
            if($order=="desc" && ($sort=='name'|| $sort=='date')){
                $sql="SELECT * FROM tbl_user WHERE `is_admin`= 'user'  ORDER BY  `$sort` desc ";
                $rides = $this->conn->query($sql);
                if(mysqli_num_rows($rides)){
                    return $rides;
                } 
            }
            if ($sort == 'day') {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `is_admin`= 'user' AND `date`> DATE_SUB(curdate(),INTERVAL 1 DAY)");
    
            } elseif ($sort == 'month') {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `is_admin`= 'user' AND  `date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)");
            } elseif ($sort == 'year') {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `is_admin`= 'user' AND  `date`> DATE_SUB(curdate(),INTERVAL 1 YEAR)");
            } else {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `is_admin`= 'user' ");
            }
            if(mysqli_num_rows($rides)>0){
                return $rides;
            }
        }
    public function pendinguser($sort,$order)
    {
        if(($order=="asc") && ($sort=='name'|| $sort=='date')){
            $sql="SELECT * FROM tbl_user WHERE `isblock`=0  ORDER BY  `$sort` asc ";
            $rides = $this->conn->query($sql);
            if(mysqli_num_rows($rides)){
                return $rides;
            }
            }
            if($order=="desc" && ($sort=='name'|| $sort=='date')){
                $sql="SELECT * FROM tbl_user WHERE `isblock`=0  ORDER BY  `$sort` desc ";
                $rides = $this->conn->query($sql);
                if(mysqli_num_rows($rides)){
                    return $rides;
                }
            }
            if ($sort == 'day') {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `isblock`=0 AND `date`> DATE_SUB(curdate(),INTERVAL 1 DAY)");
    
            } elseif ($sort == 'month') {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `isblock`=0 AND  `date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)");
            } elseif ($sort == 'year') {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `isblock`=0 AND  `date`> DATE_SUB(curdate(),INTERVAL 1 YEAR)");
            } else {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `isblock`=0");
            }
            if(mysqli_num_rows($rides)>0){
                return $rides;
            }
    }
    public function approveduser($sort,$order)
    {
        if(($order=="asc") && ($sort=='name'|| $sort=='date')){
            $sql="SELECT * FROM tbl_user WHERE `isblock`=1  ORDER BY  `$sort` asc ";
            $rides = $this->conn->query($sql);
            if(mysqli_num_rows($rides)){
                return $rides;
            }
            }
            if($order=="desc" && ($sort=='name'|| $sort=='date')){
                $sql="SELECT * FROM tbl_user WHERE `isblock`=1  ORDER BY  `$sort` desc ";
                $rides = $this->conn->query($sql);
                if(mysqli_num_rows($rides)){
                    return $rides;
                } 
            }
            if ($sort == 'day') {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `isblock`=1 AND `date`> DATE_SUB(curdate(),INTERVAL 1 DAY)");
    
            } elseif ($sort == 'month') {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `isblock`=1 AND  `date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)");
            } elseif ($sort == 'year') {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `isblock`=1 AND  `date`> DATE_SUB(curdate(),INTERVAL 1 YEAR)");
            } else {
                $rides = mysqli_query($this->conn, "SELECT * FROM tbl_user WHERE `isblock`=1");
            }
            if(mysqli_num_rows($rides)>0){
                return $rides;
            }
    }
    public function accept($id){
        $sql = "UPDATE tbl_user SET `isblock`=1
        WHERE `user_id` = '$id' ";
        $rides = $this->conn->query($sql);
        return $rides;
    }
    public function cancle($id){
        $sql = "DELETE FROM tbl_user WHERE `user_id`= '$id' ";
        $rides = $this->conn->query($sql);
        return $rides;
    }
}
class showuser extends Database
{
    public function usertable()
    {
        $sql1="SELECT * FROM `tbl_user`";
        $users = $this->conn->query($sql1);
        return $users;
    }
    public function blocked($id){
        $sql = "UPDATE tbl_user SET `isblock`=1
        WHERE `user_id` = '$id' ";
        $rides = $this->conn->query($sql);
        return $rides;
    }
    public function unblocked($id){
        $sql = "UPDATE tbl_user SET `isblock`=0
        WHERE `user_id` = '$id' ";
        $unblock = $this->conn->query($sql);
        return $unblock;
    }
    public function cancle($id){
        $sql = "DELETE FROM tbl_user WHERE `user_id`= '$id' ";
        $rides = $this->conn->query($sql);
        return $rides;
    }
    public function useraccount($id){
        $sql1="SELECT * FROM `tbl_user` WHERE `user_id`= '$id' ";
        $rides = $this->conn->query($sql1);
        if(mysqli_num_rows($rides)){
            return $rides;
        }
      
    }
    public function update($id,$name,$mobile,$password)
    {
        $sql1="SELECT * FROM `tbl_user` WHERE `user_id`= '$id' ";
        $rides = $this->conn->query($sql1);
         if ($rides->num_rows>0){
             while ($row = $rides->fetch_assoc()){
                if($row['password']==$password){
                    echo "<script>alert('Your Previous Password and new Password is same')</script>";
             }
             else{
                $sql = "UPDATE tbl_user SET `name`='$name',`mobile`='$mobile',`password`='$password'
                WHERE `user_id` = '$id' ";
                $result = $this->conn->query($sql);
                return $result;
                }
            }
         }
    }
    public function delete($id){
        $sql = "DELETE FROM tbl_user WHERE `user_id`= '$id' ";
        $result = $this->conn->query($sql);
        session_destroy();
        return $result;
    }
}
class Booking extends Database{
    public function select(){
        $sql='SELECT * FROM tbl_location';
        $result = $this->conn->query($sql);
        return $result;
    }
}
class Riderequests extends Database{
    public function select()
    {
        $sql="SELECT * FROM tbl_ride";
        $result = $this->conn->query($sql);
        return $result;
    }
    public function sortname($sort,$order)
    {
        if(($order=="asc") && ($sort=='ride_date'|| $sort=='total_fare')){
        $sql="SELECT * FROM tbl_ride  ORDER BY  `$sort` asc ";
        $rides = $this->conn->query($sql);
            if(mysqli_num_rows($rides)){
                return $rides;
            }
        }
        if($order=="desc" && ($sort=='ride_date'|| $sort=='total_fare')){
            $sql="SELECT * FROM tbl_ride  ORDER BY  `$sort` desc ";
            $rides = $this->conn->query($sql);
            if(mysqli_num_rows($rides)){
                return $rides;
            }
        }
        if ($sort == 'day') {
            $rides = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 DAY)");

        } elseif ($sort == 'month') {
            $rides = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)");
        } elseif ($sort == 'year') {
            $rides = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 YEAR)");
        } else {
            $rides = mysqli_query($this->conn, "SELECT * FROM tbl_ride" );
        }
        if(mysqli_num_rows($rides)>0){
            return $rides;
        }
    }
    // function ridereq(){
    // $sql1="SELECT * FROM `tbl_ride`  WHERE `status`=1";
    //     $rides = $this->conn->query($sql1);
    //     return $rides;
    // }
    public function ridereq($sort,$order)
    {
        if(($order=="asc") && ($sort=='ride_date'|| $sort=='total_fare')){
        $sql="SELECT * FROM tbl_ride WHERE `status`=1 ORDER BY  `$sort` asc ";
            $rides = $this->conn->query($sql);
            if(mysqli_num_rows($rides)){
                return $rides;
            }
        }
        if($order=="desc" && ($sort=='ride_date'|| $sort=='total_fare')){
            $sql="SELECT * FROM tbl_ride WHERE `status`=1 ORDER BY  `$sort` desc ";
            $rides = $this->conn->query($sql);
            if(mysqli_num_rows($rides)){
                return $rides;
            }
        }
        if ($sort == 'day') {
            $rides = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=1 AND  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 DAY)");

        } elseif ($sort == 'month') {
            $rides = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=1 AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)");
        } elseif ($sort == 'year') {
            $rides = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=1 AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 YEAR)");
        } else {
            $rides = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=1 " );
        }
        if(mysqli_num_rows($rides)>0){
            return $rides;
        }
            
    }
    public function pending($id){
        $sql = "UPDATE tbl_ride SET `status`=2
        WHERE `ride_id` = '$id' ";
        $rides = $this->conn->query($sql);
        return $rides;
    }
    public function cancle($id){
        $sql = "UPDATE tbl_ride SET `status`=0
        WHERE `ride_id` = '$id' ";
        $unblock = $this->conn->query($sql);
        return $unblock;
    }
    public function completerides($sort,$order)
    {
        if(($order=="asc") && ($sort=='ride_date'|| $sort=='total_fare')){
            $sql="SELECT * FROM tbl_ride WHERE `status`=2 ORDER BY  `$sort` asc ";
            $rides = $this->conn->query($sql);
            if(mysqli_num_rows($rides)){
                return $rides;
            }
            }
            if($order=="desc" && ($sort=='ride_date'|| $sort=='total_fare')){
                $sql="SELECT * FROM tbl_ride WHERE `status`=2 ORDER BY  `$sort` desc ";
                $rides = $this->conn->query($sql);
                if(mysqli_num_rows($rides)){
                    return $rides;
                }
            }
            if ($sort == 'day') {
                $sql = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=2 AND  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 DAY)");
    
            } elseif ($sort == 'month') {
                $sql = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=2 AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)");
            } elseif ($sort == 'year') {
                $sql = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=2 AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 YEAR)");
            } else {
                $sql = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=2" );
            }
            if(mysqli_num_rows($sql)>0){
                return $sql;
            }
        
    }
    public function canclerides($sort,$order){
        if(($order=="asc") && ($sort=='ride_date'|| $sort=='total_fare')){
            $sql="SELECT * FROM tbl_ride WHERE `status`=0 ORDER BY  `$sort` asc ";
            $rides = $this->conn->query($sql);
            if(mysqli_num_rows($rides)){
                return $rides;
            }
            }
            if($order=="desc" && ($sort=='ride_date'|| $sort=='total_fare')){
                $sql="SELECT * FROM tbl_ride WHERE `status`=0 ORDER BY  `$sort` desc ";
                $rides = $this->conn->query($sql);
                if(mysqli_num_rows($rides)){
                    return $rides;
                }
            }
            if ($sort == 'day') {
                $sql = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=0 AND  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 DAY)");
    
            } elseif ($sort == 'month') {
                $sql = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=0 AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)");
            } elseif ($sort == 'year') {
                $sql = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=0 AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 YEAR)");
            } else {
                $sql = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=0" );
            }
            if(mysqli_num_rows($sql)>0){
                return $sql;
            }
    }
    public function userinvoice($id){
        $sql1="SELECT * FROM `tbl_ride`  WHERE `ride_id`='$id' AND `status`=2";
        $rides = $this->conn->query($sql1);
        return $rides;
    }
}
class Totals extends Database{
    public function totalusers(){
        $sql="SELECT * FROM tbl_user";
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }
    public function totalrides(){
        $sql="SELECT * FROM tbl_ride";
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }
    public function totalridesrequest(){
        $sql="SELECT * FROM `tbl_ride`  WHERE `status`=1";
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }
    public function totalusersrequest(){
        $sql="SELECT * FROM `tbl_user` WHERE `isblock`=0";
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }
    public function totallocations(){
        $sql="SELECT * FROM tbl_location";
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }
    public function totalearn(){
        $sum=0;
        $sql = "SELECT * FROM `tbl_ride` where `status`=2";
        $result = $this->conn->query($sql);

        return $result;
    }
    public function usertotalride($id){
        $sql="SELECT * FROM `tbl_ride` where `customer_user_id`='$id'";
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }
    public function userpendingride($id){
        $sql="SELECT * FROM `tbl_ride` where `customer_user_id`='$id' AND `status`=1";
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }
    public function usercomride($id){
        $sql="SELECT * FROM `tbl_ride` where `customer_user_id`='$id' AND `status`=2";
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }
    public function usercancleride($id){
        $sql="SELECT * FROM `tbl_ride` where `customer_user_id`='$id' AND `status`=0";
        $result = $this->conn->query($sql);
        return $result->num_rows;
    }
}
class userrides extends Database{
    function ridereq($sort,$order,$id){
    if(($order=="asc") && ($sort=='total_fare'|| $sort=='ride_date')){
        echo '<script>alert("asc")</script>';
        $sql="SELECT * FROM tbl_ride WHERE `status`=1 AND `customer_user_id`= '$id' ORDER BY  `$sort` asc ";
        $result = $this->conn->query($sql);
        return $result;
        }
        if($order=="desc" && ($sort=='total_fare'|| $sort=='ride_date')){
            $sql="SELECT * FROM tbl_ride WHERE `status`=1 AND `customer_user_id`= '$id'  ORDER BY  `$sort` desc ";
            $result = $this->conn->query($sql);
            return $result;   
        }
        if ($sort == 'day') {
            $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=1 AND `customer_user_id`= '$id' AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 DAY)");

        } elseif ($sort == 'month') {
            $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=1 AND `customer_user_id`= '$id' AND  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)");
        } elseif ($sort == 'year') {
            $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=1 AND `customer_user_id`= '$id' AND  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 YEAR)");
        } else {
            $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=1 AND `customer_user_id`='$id' ");

        }
       return $result;
    }
    function ride($sort,$order,$id){
        if(($order=="asc") && ($sort=='total_fare'|| $sort=='ride_date')){
            $sql="SELECT * FROM tbl_ride WHERE `customer_user_id`= '$id' ORDER BY  `$sort` asc ";
            $result = $this->conn->query($sql);
            return $result;
            }
            if($order=="desc" && ($sort=='total_fare'|| $sort=='ride_date')){
                $sql="SELECT * FROM tbl_ride WHERE `customer_user_id`= '$id'  ORDER BY  `$sort` desc ";
                $result = $this->conn->query($sql);
                return $result;   
            }
            if ($sort == 'day') {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE  `customer_user_id`= '$id' AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 DAY)");
    
            } elseif ($sort == 'month') {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `customer_user_id`= '$id' AND  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)");
            } elseif ($sort == 'year') {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE  `customer_user_id`= '$id' AND  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 YEAR)");
            } else {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `customer_user_id`='$id' ");
                
            }
           return $result;
    }
    function ridecom($sort,$order,$id){

        if(($order=="asc") && ($sort=='total_fare'|| $sort=='ride_date')){
            $sql="SELECT * FROM tbl_ride WHERE `status`=2 AND `customer_user_id`= '$id' ORDER BY  `$sort` asc ";
            $result = $this->conn->query($sql);
            return $result;
            }
            if($order=="desc" && ($sort=='total_fare'|| $sort=='ride_date')){
                $sql="SELECT * FROM tbl_ride WHERE `status`=2 AND `customer_user_id`= '$id'  ORDER BY  `$sort` desc ";
                $result = $this->conn->query($sql);
                return $result;   
            }
            if ($sort == 'day') {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=2 AND `customer_user_id`= '$id' AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 DAY)");
    
            } elseif ($sort == 'month') {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=2 AND `customer_user_id`= '$id' AND  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)");
            } elseif ($sort == 'year') {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=2 AND `customer_user_id`= '$id' AND  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 YEAR)");
            } else {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=2 AND `customer_user_id`='$id' ");
                
            }
           return $result;
    }
    function userridecancle($sort,$order,$id){
        if(($order=="asc") && ($sort=='total_fare'|| $sort=='ride_date')){
            $sql="SELECT * FROM tbl_ride WHERE `status`=3 AND `customer_user_id`= '$id' ORDER BY  `$sort` asc ";
            $result = $this->conn->query($sql);
            return $result;
            }
            if($order=="desc" && ($sort=='total_fare'|| $sort=='ride_date')){
                $sql="SELECT * FROM tbl_ride WHERE `status`=3 AND `customer_user_id`= '$id'  ORDER BY  `$sort` desc ";
                $result = $this->conn->query($sql);
                return $result;   
            }
            if ($sort == 'day') {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=3 AND `customer_user_id`= '$id' AND `ride_date`> DATE_SUB(curdate(),INTERVAL 1 DAY)");
    
            } elseif ($sort == 'month') {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=3 AND `customer_user_id`= '$id' AND  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH)");
            } elseif ($sort == 'year') {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=3 AND `customer_user_id`= '$id' AND  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 YEAR)");
            } else {
                $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE `status`=3 AND `customer_user_id`='$id' ");
                
            }
           return $result;
    }
    function ridecancle($id){
        $sql1="SELECT * FROM `tbl_ride`  WHERE `status`=0 AND `customer_user_id`= '$id' ";
        $rides = $this->conn->query($sql1);
        return $rides;
    }
    function account($id){
        $sql1="SELECT * FROM `tbl_user`  WHERE `user_id`= '$id' ";
        $rides = $this->conn->query($sql1);
        return $rides;
    }
    public function cancle($id){
        $sql = "DELETE FROM `tbl_ride` WHERE `ride_id`= '$id' ";
        $result = $this->conn->query($sql);
        return $result;
    }
}