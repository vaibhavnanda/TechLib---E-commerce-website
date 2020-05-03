<?php
    session_start();
    include('dbconn.php');
    
    if (isset($_SESSION['id'])){
        header('Location:user_index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
	
    <meta charset="utf-8" />
    <title>TechLib</title>	
	
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/now-ui-kit.css?v=1.1.0" rel="stylesheet" />
    <link href="plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" >
    <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet"/>
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet"/>
    <link href="assets/style.css" rel="stylesheet"/>
	
</head>

<body class="login-page sidebar-collapse">
	
    <nav class="navbar navbar-expand-lg bg-info fixed-top navbar-transparent " color-on-scroll="400">
		<div class="container">
            <div class="navbar-translate">
                <a href="home.php" class="navbar-brand">
                    TechLib
                </a>	
                <button class="navbar-toggler navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                </button>				
	            </div>
	            <div class="collapse navbar-collapse justify-content-end" id="navigation">
	                <ul class="navbar-nav">
	                    <li class="nav-item">
	                        <a class="nav-link" href="https://twitter.com">
	                            <i class="fa fa-twitter"></i>
								<p class="d-lg-none d-xl-none">Twitter</p>
	                        </a>
	                    </li>
	                    <li class="nav-item">
	                        <a class="nav-link" rel="tooltip" href="https://www.facebook.com">
	                            <i class="fa fa-facebook-square"></i>
								<p class="d-lg-none d-xl-none">Facebook</p>
	                        </a>
	                    </li>
                </ul>
            </div>
        </div>
    </nav>
 	

        <div class="page-header ">
            <div class="page-header-image" style="background-image: url('images/backg.jpeg');"></div>
                <div class="container">
                    <div class="col-md-4 content-center">
		                <div class="card card-login card-plain">
		                    <form class="form" method="POST" action="user_login.php">
		                        <div class="header header-info text-center">
		                           <h3> Customer Login</h3>
		                        </div>
		                        <div class="content">
		                            <div class="input-group form-group-no-border input-lg">
		                                <span class="input-group-addon">
		                                    <i class="now-ui-icons users_circle-08"></i>
		                                </span>
		                                <input type="text" name="username" class="form-control" placeholder="Username">
		                            </div>
		                            <div class="input-group form-group-no-border input-lg">
		                                <span class="input-group-addon">
		                                    <i class="now-ui-icons ui-1_lock-circle-open"></i>
		                                </span>
		                                <input type="password" name="password" placeholder="Password" class="form-control" />
		                            </div>
		                        </div>
		                        <div class="footer text-center">
		                            <button type="submit" class="btn-info btn-round btn-lg btn-block" name="submit">Login</button>
		                        </div>
		                        <div class="pull-left">
		                            <h6>
		                                <a href="signup.php" class="link">Create User Account</a>
		                            </h6>
		                        </div>
		                        <div class="pull-right">
		                            <h6>
		                                <a href="" class="link">Forgot Password?</a>
		                            </h6>
		                        </div>
		                    </form>	
                    <?php

                                    if (
                                        isset($_SESSION['msg'])){
                                        echo $_SESSION['msg'];
                                        unset($_SESSION['msg']);

                                    }
                                    ?>							
	                </div>
	            </div>
	        </div>
	        <footer class="footer" data-background-color="black">
	            <div class="container">
	                <nav>
						<a href="home.php"> Techlib
						</a>
	                </nav>
	                <div class="copyright">
	                    &copy;
	                    <script>
	                        document.write(new Date().getFullYear())
	                    </script>, Designed and Coded by Vaibhav Nanda.
	                </div>
	            </div>
	        </footer>
	    </div>

</body>		

	<script src="./assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
	<script src="./assets/js/core/popper.min.js" type="text/javascript"></script>
	<script src="./assets/js/core/bootstrap.min.js" type="text/javascript"></script>
	<!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
	<script src="./assets/js/now-ui-kit.js?v=1.1.0" type="text/javascript"></script>

	
</html>				
								

	
