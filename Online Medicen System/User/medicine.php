<?php
 session_start();
    $first_name = "";
    $last_name = "";
    $email = "";
    $contact_no = "";
    $fb_handle = "";
    $tw_handle = "";

    $user_query = mysqli_query(mysqli_connect('localhost','root','','oms'),"select * from user_info");
    $server_id = $_SESSION['server_id'];
       
    while( $row = mysqli_fetch_array($user_query) )
    {
                    if( $row['server_id']==$server_id )
                    {
                        echo "<strong>";
                        echo $row['first_name']." ".$row['last_name'];
                        echo "</strong>";
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        $email = $row['email'];
                        $contact_no = $row['contact_no'];
                        
                        break;
                    }

                }
  

    
    
?>
<html>

<head>
    <title>Dashboard</title>
    <!-- Bootstrap CDN -->

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


    <!-- Custom CSS -->

    <link rel="stylesheet" href="CSS/dash.css">


    <!-- Font -->

    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">

    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">

    <link href="https://use.fontawesome.com/releases/v5.0.11/css/all.css" rel="stylesheet">


</head>

<body>
    
    <div class="container">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand active" href="dash.php">
                        <?php
                        echo '<i class="fas fa-user-tie fa-lg"></i>';
                        echo " ".$first_name." ".$last_name;
                        ?>
                    </a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#"><i class="fas fa-globe"></i>Notification</a></li>
                        <li><a href="medicine.php">Browse Medicine</a></li>
                        <li><a href="#features"><i class="fas fa-search"></i>Search</a></li>
                        <li>
                            <a href="index.php">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </li>
                        
                    </ul>

                </div>
            </div>
        </nav>
    </div>
    <br>
    <div classs="container" style="margin: 0px 20px;">
        <div class="row text-center">
            <div class="col-sm-4 col-sm-offset-4">
                <br>
                <h4 style="margin-left: 0px; color: blue; font-family: 'Satisfy', sans-serif; font-size: 40px; letter-spacing: 3px;">Medicine List</h4>
                <br>
            </div>
        </div>
        <div class="row text-center">
            <?php
                      $user_query = mysqli_query(mysqli_connect('localhost','root','','oms'),"Select * from medicinelist" );
                      while( $row = mysqli_fetch_array( $user_query) )
                      {
                        echo '<div class="col-sm-4" style=" background-color: #fffffa;">';
                            echo '<img src="css/images/'.$row['img_id'].'.jpg" alt="class photo" style="width:350px; height: 350px; border-radius: 2%;">';
                            echo '<h3 style="color: #197bbd; font-family: Montserrat, sans-serif; letter-spacing: 3px; ">'.$row['name'].'</h3>';
                            echo '<p style="color: gray; font-family: Satisfy, sans-serif; font-size: 16px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.<p>';
                            echo '<h4 style="color: #ef271b; font-family: Montserrat, sans-serif; letter-spacing: 2px; ">Price : <em>'.$row['price'].'</em></h4>';
                            
                            echo '<form action="" method="POST">
                                <div class="form-group text-center">
                                    <button type="hidden" name="addcart" value="'.$row['id'].'" class="btn-primarysignup"><span><i class="fas fa-shopping-cart"></i></span> Add To Cart</button>
                                </div>
                            </form>';
                        echo '</div>';
                      }
                 ?>
        </div>
    </div>

</body>

</html>
