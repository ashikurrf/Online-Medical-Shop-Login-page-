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

    <!-- Profile Card -->
    <br><br><br><br><br>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2">
                <div class="card">
                    <img src="CSS/images/fahim1.jpg" alt="John" style="width:100%; border-radius: 0%;">
                    <?php
                        echo '<h2 style="font-family: Montserrat, sans-serif;">'.$first_name.' '.$last_name.'</h2>';
                        echo '<p class="card_title">'.$email.'</p>';
                        echo '<p style="font-family: Montserrat, sans-serif;">'.$contact_no.'</p>';
                        echo '<div style="margin: 24px 0px;" class="card_a">
                            <a href="https://www.facebook.com/'.$fb_handle.'" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="https://www.twitter.com/'.$tw_handle.'" style="padding-left: 10px;" target="_blank"><i class="fab fa-twitter"></i></a>
                        </div>';
                    ?>
                    <p><button class="card_button" data-toggle="modal" data-target="#editprofile">Edit Profile</button></p>
                </div>
            </div>
        </div>

    </div>

</body>

</html>
