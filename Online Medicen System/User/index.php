<?php
    include('db_con.php');

$Error_No = 0;
session_start();
session_destroy();
session_start();

/*** Error Defination *******

Error : 1       [ Password & Confirm Password Does not Match ]
Error : -1      [ Account Created Successfully ]
Error : 2       [ One or More Fields Are Empty ]
Error : 3       [ SignIN Password Fields Empty ]
Error : 4       [ SignIN Username Fields Are Empty ]
Error : 5       [ SignIN Both Fields Are Empty ]
Error : -2      [ Login Success ]
Error : -3      [ Ridirect Unsucessful ]





**************************/


/******* Sign Up Button *****************/

if( isset($_POST['signup_btn']) ){
    
    $a = $_POST['signup_first_name'];
    $b = $_POST['signup_last_name'];
    $c = $_POST['signup_email'];
    $d = $_POST['signup_contact'];
          
    $server_id = 0;
    
    $user_query = mysqli_query(mysqli_connect('localhost','root','','oms'),"select * from user_info order by server_id asc");
    
    while( $row = mysqli_fetch_array($user_query) )
    {
            $server_id = $row['server_id'];
    }
    
    $server_id = $server_id + 1;

   if( !empty($_POST['signup_first_name']) && !empty($_POST['signup_last_name']) &&  !empty($_POST['signup_email']) && !empty($_POST['signup_username']) &&  !empty($_POST['signup_password']) && !empty($_POST['signup_retype_password']) && !empty($_POST['signup_contact']) )
    {
       
       if( $_POST['signup_password'] != $_POST['signup_retype_password'] )
       {
           $Error_No = 1;
       }
       else
       {
            $query = "INSERT INTO user_info(server_id,first_name,last_name,email,contact_no) values ($server_id,'$a','$b', '$c','$d')";
		  mysqli_query(mysqli_connect('localhost','root','','oms'),$query);
           
           $a = $_POST['signup_username'];
           $b = $_POST['signup_password'];
           
           $query = "INSERT INTO user_handle(server_id,username,pass) values ($server_id,'$a','$b')";
		  mysqli_query(mysqli_connect('localhost','root','','oms'),$query);
           
           $Error_No = -1;
       }
       
        
    }
    else
    {
        // field empty
        $Error_No = 2;
    }
    
}

/*********** Sign IN Button *****************************/

if( isset($_POST['signin_btn']) ){
    

   if(!empty($_POST['signin_username']) && !empty($_POST['signin_password']))
    {
            // All OK
        $user_email=$_POST['signin_username'];
		$user_password=$_POST['signin_password'];
       
        $user_query = mysqli_query(mysqli_connect('localhost','root','','oms'),"select * from user_handle");
       
        while( $row = mysqli_fetch_array($user_query) )
        {
            if($row['username']==$user_email && $row['pass']==$user_password)
            {
                $_SESSION['server_id'] = $row['server_id'];
                $Error_No = -2;
                break;
            }
           
        }
       
       if( $Error_No == -2 )
       {
           header('Location: dash.php');
       }
       else
           $Error_No = 6;
    }
    else if( !empty($_POST['signin_username']) && empty($_POST['signin_password']) )
    {
        // password empty
        $Error_No = 3;
    }
    else if( empty($_POST['signin_username']) && !empty($_POST['signin_password']) )
    {
        //username empty
        $Error_No = 4;
    }
    else
    {
        // both empty
        $Error_No = 5;
    }
    
}

?>

<head>
    <!-- Theme Made By www.w3schools.com -->
    <title>Online Medical shop</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/home.css">
</head>

<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">HOME</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="#services">SERVICES</a></li>
                    <li><a href="#about">ABOUT</a></li>
                    <li><a href="#contact">CONTACT</a></li>
                    <li><a href="" data-toggle="modal" data-target="#signinmodal">SIGN IN</a></li>
                    <li><a href="" data-toggle="modal" data-target="#signupmodal">SIGN UP</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Sign IN Modal -->
    <div class="modal fade" id="signinmodal" tabindex="-1" role="dialog" aria-labelledby="Signin" aria-hidden="true" style="margin-top:8%;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modal-primary">
                    <h4 class="modal-title text-center signinmodaltitle" id="exampleModalCenterTitle" style="color: white;">Sign In</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">

                    <br>

                    <form action="" method="POST">
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="signin_username" placeholder="Email or Username">
                        </div>
                        <div class="form-group si_passwordbox">
                            <input type="password" class="form-control no-border" name="signin_password" placeholder="Password">
                        </div>
                        <div class="text-center">
                            <a href="" data-toggle="modal" data-target="#signupmodal" style="font-size: 12px; font-family: Montserrat, sans-serif;">Don't Have An Account! Sign Up Now</a>
                        </div>

                        <br>
                        <div class="form-group text-center">
                            <button type="submit" name="signin_btn" class="btn btn-primaryp">Sign In</button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>


    <!-- Sign UP Modal -->
    <div class="modal fade" id="signupmodal" tabindex="-1" role="dialog" aria-labelledby="SignUP" aria-hidden="true" style="margin-top:3%;">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header modal-primary">
                    <h4 class="modal-title text-center signinmodaltitle" id="exampleModalCenterTitle" style="color: white;">Sign Up</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color: white;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">

                    <br>

                    <form action="" method="POST">
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="signup_first_name" placeholder="First Name">
                        </div>
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="signup_last_name" placeholder="Last Name">
                        </div>
                        <div class="form-group si_usernamebox">
                            <input type="email" class="form-control no-border" name="signup_email" placeholder="Email">
                        </div>
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="signup_username" placeholder="Username">
                        </div>
                        <div class="form-group si_passwordbox">
                            <input type="password" class="form-control no-border" name="signup_password" placeholder="New Password">
                        </div>
                        <div class="form-group si_passwordbox">
                            <input type="password" class="form-control no-border" name="signup_retype_password" placeholder="Retype Password">
                        </div>
                        <div class="form-group si_usernamebox">
                            <input type="text" class="form-control no-border" name="signup_contact" placeholder="Contact No">
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="signup_btn" class="btn btn-primaryp">Sign Up</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <div class="jumbotron text-center">
        <h1>Welcome</h1>
        <p>Online Medical Shop</p>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    <form>
                        <div class="input-group">
                            <input type="email" class="form-control" size="50" placeholder="Email Address" required>
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary">Subscribe</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Section -->

    <div class="row">
        <div class="container">
            <div class="col-sm-4 col-sm-offset-4">
                <?php
                        
                        if( $Error_No == 1  ){
                            echo '<div class="alert alert-warning text-center">
                                      <strong>Password</strong> Does not match
                            </div>';
                        }
                        else if( $Error_No == 2 )
                        {
                            echo '<div class="alert alert-warning text-center">
                                      all fields are required
                            </div>';
                        }
                        else if( $Error_No == -1 )
                        {
                            echo '<div class="alert alert-success text-center">
                                      Please <a href="" data-toggle="modal" data-target="#signinmodal"> Signin </a> to Continue
                            </div>';
                        }
                        else if( $Error_No >= 3 && $Error_No <= 6 )
                        {
                            echo '<div class="alert alert-danger text-center">
                                      invalid username or password
                            </div>';
                        }
                        
    ?>
            </div>
        </div>
    </div>

    <!-- Container (Services Section) -->
    <div id="services" class="container-fluid text-center">
        <h2>SERVICES</h2>
        <h4>What we offer</h4>
        <br>
        <div class="row slideanim">
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-search logo-small"></span>
                <h4>Search</h4>
                <p>Lorem ipsum dolor sit amet..</p>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-tint logo-small"></span>
                <h4>BLOOD</h4>
                <p>Lorem ipsum dolor sit amet..</p>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-plus logo-small"></span>
                <h4>Medical PLUS</h4>
                <p>Lorem ipsum dolor sit amet..</p>
            </div>
        </div>
        <br><br>
        <div class="row slideanim">
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-leaf logo-small"></span>
                <h4>GREEN</h4>
                <p>Lorem ipsum dolor sit amet..</p>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-shopping-cart logo-small"></span>
                <h4>Add cart</h4>
                <p>Lorem ipsum dolor sit amet..</p>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-wrench logo-small"></span>
                <h4 style="color:#303030;">HARD WORK</h4>
                <p>Lorem ipsum dolor sit amet..</p>
            </div>
        </div>
    </div>



    <!-- Container (About Section) -->
    <div id="about" class="container-fluid bg-grey">
        <div class="row">
            <div class="col-sm-8">
                <h2>ABOUT PHARMEASY</h2><br>
                <h4>Bangladesh Leading and Most-trusted Online Healthcare Aggregator.</h4><br>
                <p>Tired of rushing to the nearest chemist/ medical store to buy monthly medicines? You need not do so anymore! PharmEasy, your very own online healthcare and medicine delivery platform delivers genuine medicines right to your doorstep.</p>

                <p>PharmEasy is pharmacy made easy,Easy to find medicin.Fast delivery in bangladesh . In a short span of three years, we have established ourselves as India’s leading online healthcare and medicine delivery platform, catering to two million customers pan Bangladesh. Through our mobile app and website, we help customers (patients and their caregivers) connect with local pharmacy stores and diagnostic centers to fulfill their extensive medical needs. We firmly believe that everyone should have access to good health and that health care should be affordable to all. Taking this belief forward, we offer genuine medicines at FLAT 20% OFF, up to 70% OFF on Diagnostic tests and up to 50% OFF on healthcare products, ensuring highest savings in the shortest time possible.</p>
                <br><button class="btn btn-default btn-lg">Get in Touch</button>
            </div>
            <div class="col-sm-4">
                <span class="glyphicon glyphicon-signal logo"></span>
            </div>
        </div>
    </div>


    <!-- Container (Contact Section) -->
    <div id="contact" class="container-fluid">
        <h2 class="text-center">CONTACT</h2>
        <div class="row">
            <div class="col-sm-5">
                <p>Contact us and we'll get back to you within 24 hours.</p>
                <p><span class="glyphicon glyphicon-map-marker"></span> Dhaka, BD</p>
                <p><span class="glyphicon glyphicon-phone"></span> +8801622203..</p>
                <p><span class="glyphicon glyphicon-envelope"></span> medical@gmail.com</p>
            </div>
        </div>
    </div>


    <footer class="container-fluid text-center" style="background-color: black; color: white;">
        <a href="#myPage" title="To Top">
            <span class="glyphicon glyphicon-chevron-up"></span>
        </a>
        <p> Live for people </p>
    </footer>

    <script>
        $(document).ready(function() {
            // Add smooth scrolling to all links in navbar + footer link
            $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
                // Make sure this.hash has a value before overriding default behavior
                if (this.hash !== "") {
                    // Prevent default anchor click behavior
                    event.preventDefault();

                    // Store hash
                    var hash = this.hash;

                    // Using jQuery's animate() method to add smooth page scroll
                    // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
                    $('html, body').animate({
                        scrollTop: $(hash).offset().top
                    }, 900, function() {

                        // Add hash (#) to URL when done scrolling (default click behavior)
                        window.location.hash = hash;
                    });
                } // End if
            });

            $(window).scroll(function() {
                $(".slideanim").each(function() {
                    var pos = $(this).offset().top;

                    var winTop = $(window).scrollTop();
                    if (pos < winTop + 600) {
                        $(this).addClass("slide");
                    }
                });
            });
        })

    </script>

</body>

</html>
