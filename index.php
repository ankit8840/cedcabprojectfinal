<?php
    require 'class.php';
    $welcome='';
    if(!empty($_SESSION['userdata'])){
    $welcome=$_SESSION['userdata']['name'];
    }
    $con = new Booking();
    $con->connect('localhost', 'root', '', 'newtasks');
    $loc=$con->select();
    $drop=$con->select();
   
?>
<!DOCTYPE html>
<html>

<head>
    <title>CEDCABS</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="ola.css">
</head>

<body>
    <div class="container-fluid pl-0 pr-0">
        <nav class="navbar navbar-expand-lg navbar-light" id="navbar">
            <div class="container">
                <img src="olaimg.png" id="logo" alt="Logo">

                <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarid">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarid">
                    <ul class="navbar-nav ml-auto">
                    <?php if(!empty($_SESSION["userdata"])):?>
                        <li class="nav-item">
                       
                            <a class="nav-link" href="userdashboard.php">Home</a>
                        </li>
                        <?php endif; ?>
                        <li class="nav-item" style="display: block ruby;">
                            <?php if(!empty($_SESSION["userdata"])){
                                $link1="logout.php";
                                $linkname1="Log Out";
                                $link2="";
                                    $linkname2="";
                                }else{
                                    $link1="singup.php";
                                    $linkname1="SIGN UP";
                                    $link2="login.php";
                                    $linkname2="LOGIN";
                                }?>
                            <a class="nav-link" href=<?php echo $link1 ?>><?php echo $linkname1 ?></a>
                            <a class="nav-link" href=<?php echo $link2 ?>><?php echo $linkname2 ?></a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="container-fluid">
        <div class="row" id="section">
            <div class="col-sm-12 col-md-12 pl-0 pr-0">
                <img class="w-100 h-100 img-fluid" src="cab.jpg" alt="First slide">
                <div class="col-sm-6 col-md-12 text-center pb-5">
                    <h1>WELCOME<?php echo " ".$welcome ?></h1>
                    <h1>Book a city Taxi to your Destination in Town</h1>
                    <h4>Choose From a range and categories and price</h4>
                </div>
                <div class="col-sm-12 col-md-6 ml-2" id="form1">
                    <div class="text-center">
                        <h6 class="pt-2 pb-2"><span class="p-3">CITY TAXI</span></h6>
                    </div>
                    <div class="text-center">
                        <h4>Your Everyday Travel Partner</h4>
                        <h5>AC Cabs for Point to Point Travel</h5>
                    </div>
                    <form method="POST">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <p class="input-group-text" id="inputGroup-sizing-default">pickup</p>
                                </div>
                                <select class="form-control" id="pickup" name="pickup">
                                <?php if ($loc->num_rows>0) :?>
                                    <?php while ($row = $loc->fetch_assoc()) :?>
                                    <option class="dropdown-item" href="#"><?php echo $row['loc_name']?></option>
                                    <?php endwhile;?>
                                <?php endif; ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <p class="input-group-text" id="inputGroup-sizing-default">Drop</p>
                                </div>
                                <select class="form-control" id="drop" name="drop">
                                <?php if ($drop->num_rows>0) :?>
                                    <?php while ($row = $drop->fetch_assoc()) :?>
                                    <option class="dropdown-item" href="#"><?php echo $row['loc_name']?></option>
                                    <?php endwhile;?>
                                <?php endif; ?>
                                </select>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <p class="input-group-text" id="inputGroup-sizing-default">cartype</p>
                                </div>
                                <select class="form-control" id="cartype" name="cartype">
                                    <option class="dropdown-item">Select car</option>
                                    <option class="dropdown-item" value="Micro">Micro</option>
                                    <option class="dropdown-item" value="Mini">Mini</option>
                                    <option class="dropdown-item" value="Sedan">Sedan</option>
                                    <option class="dropdown-item" value="Suv">Suv</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group" id="bags">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <p class="input-group-text" id="inputGroup-sizing-default">Luggage</p>
                                </div>
                                <input type="text" class="form-control" class="checkdot" id="weight" name="weight" placeholder="Enter Weight in Kg">
                                <p id="mss">

                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" class="form-control btn btn-primary calfare" id="submit"
                                data-target="#mymodel" name="fare">Calculate Fare</button>
                        </div>
                        <div class="form-group">
                            <button type="button" name="book" class="form-control btn btn-primary calfare" id="book"
                                data-target="#mymodel">Book Now</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div id="result">

        </div>
    </div>
    <div class="container-fluid pl-0 pr-0">
        <footer class="page-footer p-3 text-center">
            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4" id="footer">
                <a><i class="fa fa-facebook-square"></i></a>
                <a><i class="fa fa-twitter-square"></i></a>
                <a><i class="fa fa-instagram"></i></a>
                <div class="footer-copyright text-center font-small pt-0 pb-0" id="copyright">© 2020 Copyright:
                    <a href="#">Cedcabs.com</a>
                </div>
            </div>
        </footer>
    </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="ola.js"></script>
    <!--  --><?php
    
    ?>