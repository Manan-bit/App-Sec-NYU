<?php include('UserHeader.php');

$val = !empty($_SESSION["uid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?login=user'</script>";
}
$uid_session = $_SESSION["uid_session"];

?>

 <style>	
		body
		{
			background: url('images/practicalforensicmain-banner.jpg') no-repeat;
			background-size: cover;
		}	
 </style>

<div class="content">  
		<div class="container">
		<div class="col-md-12 div_selectcase">
			<div class="col-md-6">
				<div class="innerdiv_selectcase">
					<a href="ViewCase.php?casetype=For Game">
					<i class="fa fa-gamepad icon" style="font-size:70px; color:white;"></i>
					<h3 style="color:white;">For Game</h3>
					</a>
				</div>
			</div>
			<div class="col-md-6">
				<div class="innerdiv_selectcase">
					<a href="ViewCase.php?casetype=For Practice">
					<i class="fa fa-play icon" style="font-size:70px; color:white;"></i>
					<h3 style="color:white;">For Practice</h3>
					</a>
				</div>
			</div>
		</div>
		</div>
		
</div>
		
<?php include('footer.php') ?>