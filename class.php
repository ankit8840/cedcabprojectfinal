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
                die(mysqli_error($this->conn));
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
        $sql ='SELECT * FROM tbl_user WHERE BINARY
        `user_name`="'.$username.'" AND 
        `password`="'.$password.'" AND `isblock`="'.$isblock.'"';
        $result = $this->conn->query($sql);
        if ($result->num_rows>0) {
            while ($row = $result->fetch_assoc()) {
                $_SESSION["userdata"]=array('name' => $row['name'],
                'userid'=>$row['user_id']);
            }
            // header("Refresh:0; url=../index.html");
        } else {
            $rtn = "Login Failed";
        }
        return $rtn;
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
    public function select()
    {
        $user="user";
        $sql="SELECT * FROM tbl_user  WHERE `is_admin`= '$user' ";
        $result = $this->conn->query($sql);
        return $result;
    }
    public function pendinguser()
    {
        $sql1="SELECT * FROM `tbl_user` WHERE `isblock`=0";
        $rides = $this->conn->query($sql1);
        return $rides;
    }
    public function approveduser()
    {
        $sql1="SELECT * FROM `tbl_user` WHERE `isblock`=1";
        $rides = $this->conn->query($sql1);
        return $rides;
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
        return $rides;
    }
    public function update($id,$name,$mobile,$password)
    {
        $sql = "UPDATE tbl_user SET `name`='$name',`mobile`='$mobile',`password`='$password'
        WHERE `user_id` = '$id' ";
        $result = $this->conn->query($sql);
        return $result;
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
    public function sortname($name)
    {
        $sql="SELECT * FROM tbl_ride  ORDER BY  $name ";
        $result = $this->conn->query($sql);
        return $result;
    }
    function ridereq(){
    $sql1="SELECT * FROM `tbl_ride`  WHERE `status`=1";
        $rides = $this->conn->query($sql1);
        return $rides;
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
    public function completerides($sort)
    {
        if ($sort == 'day') {
            $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 DAY) ");
        } elseif ($sort == 'month') {
            $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 MONTH) ");
        } elseif ($sort == 'year') {
            $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride WHERE  `ride_date`> DATE_SUB(curdate(),INTERVAL 1 YEAR) ");
        } else {
            $result = mysqli_query($this->conn, "SELECT * FROM tbl_ride ");
        }
       
            return $result;
        
    }
    public function canclerides(){
        $sql1="SELECT * FROM `tbl_ride`  WHERE `status`=0";
        $rides = $this->conn->query($sql1);
        return $rides;
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
    function ridereq($id){
        $sql1="SELECT * FROM `tbl_ride`  WHERE `status`=1 AND `customer_user_id`= '$id' ";
        $rides = $this->conn->query($sql1);
        return $rides;
    }
    function ride($id){
        $sql1="SELECT * FROM `tbl_ride`  WHERE `customer_user_id`= '$id' ";
        $rides = $this->conn->query($sql1);
        return $rides;
    }
    function ridecom($id){
        $sql1="SELECT * FROM `tbl_ride`  WHERE `status`=2 AND `customer_user_id`= '$id' ";
        $rides = $this->conn->query($sql1);
        return $rides;
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
}