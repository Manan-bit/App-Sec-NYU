<?php session_start();
include("connection.php");
if(isset($_GET['login']))
{
?>
<!DOCTYPE html>
<html>
<head>
    <title>Practical Forensics 101</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />  	
	<link rel="stylesheet" href="css/style.css">
	
	<style>	
		body
		{
			background: url('images/forensiclogin-banner.png') no-repeat;
			background-size: cover;
		}	
	</style>
		  
</head>
<body>

	<div class="container">
		<div class="col-md-12">
			<div class="lgndiv">
				<div class="form-group">
				<?php
				if($_GET['login'] == "admin")
				{
				?>
					<h2 class="head">Admin Login</h2>
				<?php	
				}
				else
				{
				?>
					<h2 class="head">User Login</h2>
				<?php
				}
				?>
				</div>
				
		  <form id="myform" method="post">
		
				<div class="form-group" style="margin-top:10%;">
				
				<?php
				if($_GET['login'] == "admin")
				{
				?>
					<input type="text" class="txtbox" name="email" id="inputEmail" placeholder="Enter Admin ID">
				<?php	
				}
				else
				{
				?>
					<input type="email" class="txtbox" name="email" placeholder="Enter Email" />
				<?php
				}
				?>	
				</div>
				
				<div class="form-group">
				<input type="password" class="txtbox" name="pswd" placeholder="Enter Password" />
				</div>
				
				<div class="form-group">
					<input type="submit" class="lgnbtn" name="btn_login" value="Login" />
				</div>
				
				<?php
				if($_GET['login'] == "admin")
				{
				?>
				
				<?php	
				}
				else
				{
				?>
					<div class="form-group">
						<span style="color: #4a4a4a;">Not Registered ? <a href="Register.php" style="text-decoration: none;color: #2473c7;">Create an account</a></span>
					</div>
					
				<?php
				}
				?>		
								
				<center style="color: blue; font-weight: bold;"><a href="index.php"> <i class="fa fa-arrow-left"></i> Back</a></center>
				<br/>
				
		   </form>
				
		</div>
	</div>
	</div>

<?php

if(isset($_POST['btn_login']))
{	
    $email = $_POST['email'];	
    $pswd = $_POST['pswd'];
	
	if($email == "admin" && $pswd == "admin")
	{
		$sel = "select adminid from admin where adminid='$email' and password='$pswd'";
		$rel=$con->query($sel);	
		
		if($data=mysqli_fetch_array($rel))
		{
			$adminid = $data['adminid'];
			
			$_SESSION["adminid_session"] = $adminid;
		
			echo "<script>window.location.href='AddCase.php'</script>";							
		}
		else
		{
			echo "<script>alert('Invalid Login');</script>";
		}
	}
	else
	{		
		$sel = "select uid from userregister where emailid='$email' and password='$pswd'";
		$rel=$con->query($sel);			   
		if($data=mysqli_fetch_array($rel))
		{
			$uid = $data['uid'];					
			
			$_SESSION["uid_session"] = $uid;			
						
			echo "<script>window.location.href='SelectCase.php'</script>";							
		}
		else
		{
			echo "<script>alert('Invalid Login');</script>";
		}
	}				
}

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/jquery.validate.min.js"></script>

<script>

    $(function()
    {
            $("#myform").validate({
            
            rules:{
                email: {
					<?php
				if($_GET['login'] == "admin")
				{
				?>
                    required:true
				<?php	
				}
				else
				{
				?>	
				   required:true,
                   email:true
				<?php
				}
				?> 
				
                },			
                pswd : "required",
				
           },

            messages:{
				<?php
				if($_GET['login'] == "admin")
				{
				?>
					email:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Admin ID</b></h5>",
				<?php	
				}
				else
				{
				?>
					email:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Email</b></h5>",
				<?php
				}
				?>
				
                pswd:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Password</b></h5>",
                							
            },

            submitHandler: function(form){
                form.submit();
            }

        });

    }); 
	
</script>


<?php
}
else
{
	echo "<script>window.location.href = 'index.php';</script>";
}
?>

</body>
</html>