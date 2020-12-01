<?php
    require 'class.php';
    $con = new Location();
    $action=0;
    $con->connect('localhost', 'root', '', 'newtasks');
    $loc=$con->select();
    global $ten,$fifty,$hun;
    $pickup=$_REQUEST["pickup"];
    $drop=$_REQUEST["drop"];
    $cartype=$_REQUEST["cartype"];
    $weight=$_REQUEST["weight"];
    if(isset($_POST['action']))
    $action=$_REQUEST["action"];
    if ($loc->num_rows>0){
        while ($row = $loc->fetch_assoc()) {
            if($row['loc_name']==$pickup){
                $pickupkm=$row['loc_distance'];
            }
            if($row['loc_name']==$drop){
                $dropkm=$row['loc_distance'];
            }
       }
       
    }
   
    $totaldistance=abs($pickupkm-$dropkm);
    echo "Total Distance : ".$totaldistance."KM"."\n";
    if($cartype=="Micro"){
        $fare=50;
        if($totaldistance<=10){
            $firstten=$totaldistance*13.5;
            $fare=$fare+$firstten;
            echo "Total Fare :  $".$fare;
        }
        if($totaldistance>10 && $totaldistance<=50){
            $ten=10*13.5;
            $dis=$totaldistance-10;
            $nextfifty=$dis*12;
            $fare=$fare+$nextfifty+$ten;
            echo "Total Fare : $".$fare;
        }
        if($totaldistance>50 && $totaldistance<=100){
            $ten=10*13.5;
            $fifty=50*12;
            $dis=$totaldistance-60;
            $nexthun=$dis*10.20;
            $fare=$fare+$nexthun+$ten+$fifty;
            echo "Total Fare : $".$fare;
        }
        if($totaldistance>100){
            $ten=10*13.5;
            $fifty=50*12;
            $hun=100*10.2;
            $dis=$totaldistance-160;
            $above=$dis*8.50;
            $fare=$fare+$hun+$ten+$fifty+$above;
            echo "Total Fare : $".$fare;
        }
    }
    if($cartype=="Mini"){
        $fare=150;
        if($weight == "")
        {
            $fare=$fare+0;
        }
        if($weight<=10){
            $fare=$fare+50;
        }
        if($weight>10 && $weight<=20){
            $fare=$fare+100;
        }
        if($weight>20){
            $fare=$fare+200;
        }
        if($totaldistance<=10){
            $firstten=$totaldistance*14.5;
            $fare=$fare+$firstten;
            echo "Total Fare : $".$fare;
        }
        if($totaldistance>10 && $totaldistance<=50){
            $ten=10*14.5;
            $dis=$totaldistance-10;
            $nextfifty=$dis*13;
            $fare=$fare+$nextfifty+$ten;
            echo "Total Fare : $".$fare;
        }
        if($totaldistance>50 && $totaldistance<=100){
            $ten=10*14.5;
            $fifty=50*13;
            $dis=$totaldistance-60;
            $nexthun=$dis*11.20;
            $fare=$fare+$nexthun+$ten+$fifty;
            echo "Total Fare : $".$fare;
        }
        if($totaldistance>100){
            $ten=10*14.5;
            $fifty=50*13;
            $hun=100*11.2;
            $dis=$totaldistance-160;
            $above=$dis*9.50;
            $fare=$fare+$hun+$ten+$fifty+$above;
            echo "Total Fare : $".$fare;
        }
    } 
    if($cartype=="Sedan"){
        $fare=200;
        if($weight<=10){
            $fare=$fare+50;
        }
        if($weight>10 && $weight<=20){
            $fare=$fare+100;
        }
        if($weight>20){
            $fare=$fare+200;
        }
        if($totaldistance<=10){
            $firstten=$totaldistance*15.5;
            $fare=$fare+$firstten;
            echo "Total Fare : $".$fare;
        }
        if($totaldistance>10 && $totaldistance<=50){
            $ten=10*15.5;
            $dis=$totaldistance-10;
            $nextfifty=$dis*14;
            $fare=$fare+$nextfifty+$ten;
            echo "Total Fare : $".$fare;
        }
        if($totaldistance>50 && $totaldistance<=100){
            $ten=10*15.5;
            $fifty=50*14;
            $dis=$totaldistance-60;
            $nexthun=$dis*12.20;
            $fare=$fare+$nexthun+$ten+$fifty;
            echo "Total Fare : $".$fare;
        }
        if($totaldistance>100){
            $ten=10*15.5;
            $fifty=50*14;
            $hun=100*12.20;
            $dis=$totaldistance-160;
            $above=$dis*10.50;
            $fare=$fare+$hun+$ten+$fifty+$above;
            echo "Total Fare : $".$fare;
        }
    }
    if($cartype=="Suv"){
        $fare=250;
        if($weight<=10){
            $fare=$fare+100;
        }
        if($weight>10 && $weight<=20){
            $fare=$fare+200;
        }
        if($weight>20){
            $fare=$fare+400;
        }
        if($totaldistance<=10){
            $firstten=$totaldistance*16.5;
            $fare=$fare+$firstten;
            echo "Total Fare : $".$fare;
        }
        if($totaldistance>10 && $totaldistance<=50){
            $ten=10*16.5;
            $dis=$totaldistance-10;
            $nextfifty=$dis*15;
            $fare=$fare+$nextfifty+$ten;
            echo "Total Fare : $".$fare;
        }
        if($totaldistance>50 && $totaldistance<=100){
            $ten=10*16.5;
            $fifty=50*15;
            $dis=$totaldistance-60;
            $nexthun=$dis*13.20;
            $fare=$fare+$nexthun+$ten+$fifty;
            echo "Total Fare : $".$fare;
        }
        if($totaldistance>100){
            $ten=10*16.5;
            $fifty=50*15;
            $hun=100*13.20;
            $dis=$totaldistance-160;
            $above=$dis*11.50;
            $fare=$fare+$hun+$ten+$fifty+$above;
            echo "Total Fare : $".$fare;
        }
    }
    if(!empty($_SESSION['userdata'])) {
        if ($action==1) {
            $con1 = new Database();
            $con1->connect('localhost', 'root', '', 'newtasks');
            $userid=$_SESSION['userdata']['userid'];
            $status=1;
            echo $pickup,$drop, $totaldistance, $weight, $fare, $userid;
                $_SESSION['invoice']=array('pickup' => $pickup,
                'drop'=>$drop,'distance'=>$totaldistance,'luggage'=>$weight,'fare'=>$fare);
                $fields = array('pickup', 'droploc', 'total_distance','luggage','total_fare','status','customer_user_id');
                $data = array($pickup, $drop, $totaldistance, $weight, $fare, $status, $userid);
        
                $res = $con1->insert($fields, $data, 'tbl_ride');
                return $res;
                // if ($res) 
                // {
                //     echo "<script>alert('inserted')</script>";
                //     $error=array('input'=>'form','msg'=>"1 Row inserted");
                // }

        }
    }else{
        $status=1;
        $_SESSION['booking']=array('pickup' => $pickup,
    'drop'=>$drop,'distance'=>$totaldistance,'luggage'=>$weight,'fare'=>$fare,'status'=>1);
    }

?>