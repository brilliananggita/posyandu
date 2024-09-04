<?php 
$koneksi = new mysqli("localhost", "root", "", "puskes");

session_start();
if (isset($_SESSION['username'])) {
    header("Location: user.php");
}
  
if (isset($_POST['submit'])) {
    $user = $_POST['user'];
    $pass = MD5($_POST['pass']);
  
    $sql = "SELECT * FROM user WHERE user='$user' AND pass='$pass'";
    $result = mysqli_query($koneksi, $sql);

    $cek = mysqli_num_rows($result);
    if ($cek > 0) {
        $data = mysqli_fetch_assoc($result);
        if ($data['level'] == 'admin') {
            $_SESSION['id_petugas'] = $data['id_petugas'];
            $_SESSION['nama_petugas'] = $data['nama_petugas'];
            $_SESSION['login'] = "admin";
            header('location: index.html');
        } elseif ($data['level'] == 'petugas') {
            $_SESSION['id_petugas'] = $data['id_petugas'];
            $_SESSION['nama_petugas'] = $data['nama_petugas'];
            $_SESSION['login'] = "petugas";
            header('location: index.php');
        }
    } else {
        $sql = "SELECT * FROM user WHERE user='$user' AND pass='$pass'";
        $result = mysqli_query($koneksi, $sql);
        if ($result->num_rows > 0) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['username'] = $row['user'];
            $_SESSION['nik'] = $row['nik'];

            header("Location: index.php");
        } else {
            echo "<script>alert('USER DAN PASWORD TIDAK DITEMUKAN!');</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en"> 
<head>
    <title>Posyandu</title>
    
    <!-- Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="description" content="Portal - Bootstrap 5 Admin Dashboard Template For Developers">
    <meta name="author" content="Xiaoying Riley at 3rd Wave Media">    
    <link rel="shortcut icon" href="logoposyandu.png"> 
    
    <!-- FontAwesome JS-->
    <script defer src="assets/plugins/fontawesome/js/all.min.js"></script>
    
    <!-- App CSS -->  
    <link id="theme-style" rel="stylesheet" href="assets/css/portal.css">


</head> 

<body class="app app-login p-0" >    	
    <div class="row g-0 app-auth-wrapper" style="background-image: url('bg.jpg'); background-size: cover;
            background-position: center;">
	    <div class="col-12 col-md-7 col-lg-6 auth-main-col text-center p-5">
		    <div class="d-flex flex-column align-content-end">
			    <div class="app-auth-body mx-auto">	
				    <div class="app-auth-branding mb-4"><a class="app-logo" href="index.html"><img class="logo-icon" src="logoposyandu.png" alt="logo" style="width: 20%;height: 20%;"></a></div>
					<h2 class="auth-heading text-center mb-5">Log in</h2>
			        <div class="auth-form-container text-start">
						<form action="" method="POST" class="auth-form login-form">         
							<div class="email mb-3">
								<label class="sr-only" for="signin-email">Username</label>
								<input id="login" name="user" type="text" class="form-control signin-email" placeholder="Username" required="required">
							</div><!--//form-group-->
							<div class="password mb-3">
								<label class="sr-only" for="signin-password">Password</label>
								<input id="password" name="pass" type="password" class="form-control signin-password" placeholder="Password" required="required">
								<div class="extra mt-3 row justify-content-between">
									<div class="col-6">
										<div class="form-check">
											<input class="form-check-input" type="checkbox" value="" id="RememberPassword">
											<label class="form-check-label" for="RememberPassword">
											Remember me
											</label>
										</div>
									</div><!--//col-6-->
									<div class="col-6">
										<div class="forgot-password text-end">
											<a href="reset-password.html">Forgot password?</a>
										</div>
									</div><!--//col-6-->
								</div><!--//extra-->
							</div><!--//form-group-->
							<div class="text-center">
								<button name="submit" type="submit" value="login" class="btn app-btn-primary w-100 theme-btn mx-auto">Log In</button>
							</div>
						</form>
						
						<div class="auth-option text-center pt-5">No Account? Sign up <a class="text-link" href="signup.html" >here</a>.</div>
					</div><!--//auth-form-container-->	

			    </div><!--//auth-body-->
				

		    
			    <footer class="app-auth-footer">
				    <div class="container text-center py-3">
				         <!--/* This template is free as long as you keep the footer attribution link. If you'd like to use the template without the attribution link, you can buy the commercial license via our website: themes.3rdwavemedia.com Thank you for your support. :) */-->
			        <small class="copyright">Designed with <span class="sr-only">love</span><i class="fas fa-heart" style="color: #fb866a;"></i> by <a class="app-link" href="http://themes.3rdwavemedia.com" target="_blank">Xiaoying Riley</a> for developers</small>
				       
				    </div>
			    </footer><!--//app-auth-footer-->	
		    </div><!--//flex-column-->   
	    </div><!--//auth-main-col-->
		<div class="col-6 col-md-7 col-lg-6 auth-main-col text-center p-5">

				<img src="image.png" style="background-position: center; height: 70%; width: 70%;">
</div>
    
    </div><!--//row-->


</body>
</html> 

