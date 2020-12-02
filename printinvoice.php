<?php
require 'class.php';
$conn1 = new Riderequests();
$name=$_SESSION["userdata"]["name"];
$conn1->connect('localhost', 'root', '', 'newtasks');
$rideid=$_GET["rideid"];
$ride=$conn1->userinvoice($rideid);
?>
<?php require 'adminnav.html'?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div id="tiles">
    <?php if ($ride->num_rows>0) :?>
     <?php while ($row = $ride->fetch_assoc()) :?>
        
        <div id="invoice">
            <h1 style="color:black;">User Invoice</h1>
            <div>
                <label>Name:-   </label><span><?php echo $name ?></span>
            </div>
            <div>
                <label>Pickup Point:-   </label><span><?php echo $row['pickup'] ?></span>
            </div>
            <div>
                <label>Drop Point:-   </label><span><?php  echo $row['droploc'] ?></span>
            </div>
            <div>
                <label>Total Distance:-  </label><span><?php  echo $row['total_distance'] ?></span>
            </div>
            <div>
                <label>Luggage:-  </label><span><?php  echo $row['luggage'] ?></span>
            </div>
            <div>
                <label>Total Fare:-  </label><span><?php  echo $row['total_fare'] ?></span>
            </div>
            <div>
                <label>Date:-  </label><span><?php  echo $row['ride_date'] ?></span>
            </div>
           
        <div>
        <button  id="download" onclick="window.print()">Print</button>
     <?php endwhile;?>
     <?php endif;?>
    </table>
</div>
</body>
</html>
