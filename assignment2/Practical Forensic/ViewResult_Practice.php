<?php include('UserHeader.php');

$val = !empty($_SESSION["uid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?login=user'</script>";
}
$uid_session = $_SESSION["uid_session"];

?>


<div class="content">
<div class="container">

<?php

$casetype = $_GET['casetype'];
$caseid = $_GET['caseid'];
$pid = $_GET['pid'];

?>

<h3 style="text-align:center;">View Results</h3>
<h4 style="float:left;"><i class="fa fa-arrow-left" style="font-size:18px;color:blue"></i><a href="ViewCase.php?casetype=<?php echo $casetype ?>">View Case</a></h4>

</br>

<?php

if($casetype == "For Practice")
{
	if(isset($_GET['timeup']) && isset($_GET['pid']))
	{							
		$update = "Update caseprocess set status='Incomplete',timer='0' where pid='$pid'";				
		if(mysqli_query($con, $update))
		{		
		}
		else
		{
		}
		
		echo "<center><h3>Your Time is Up. You have not successfully attempted all the Questions</h3></center>";				
	}

	if(isset($_GET['quest']) && isset($_GET['pid']))
	{			
		$update = "Update caseprocess set status='Finished',timer='' where pid='$pid'";				
		if(mysqli_query($con, $update))
		{		
		}
		else
		{
		}

		echo "<center><h3>You have successfully attempted all the Questions!!!</h3></center>";	
	}


	if($caseid == 101)
	{
		
		echo '<div align="center" style="margin-left: 38%;"><div class="col-md-2 col-lg-2">
			<a href="StartCase_System.php?casetype='.$casetype.'&caseid='.$caseid.'"><input type="button" class="btn btn-success" value="System Case"/></a>
		</div>
		
		<div class="col-md-2 col-lg-2">
			<input type="button" class="btn btn-success" value="Network Case"/>
		</div></div>';
	}	
	else if($caseid == 102)
	{
		echo '<div align="center" style="margin-left: 38%;"><div class="col-md-2 col-lg-2">
				<a href="StartCase_Email.php?casetype='.$casetype.'&caseid='.$caseid.'"><input type="button" class="btn btn-success" value="Email Case"/></a>
			</div>
			
			<div class="col-md-2 col-lg-2">
			<input type="button" class="btn btn-success" value="Network Case"/>
		</div></div>';	
	}
	else if($caseid == 103)
	{
		echo '<div align="center" style="margin-left: 38%;"><div class="col-md-2 col-lg-2">
				<a href="StartCase_Email.php?casetype='.$casetype.'&caseid='.$caseid.'"><input type="button" class="btn btn-success" value="Email Case"/></a>
			</div>
			
			<div class="col-md-2 col-lg-2">
			<a href="StartCase_System.php?casetype='.$casetype.'&caseid='.$caseid.'"><input type="button" class="btn btn-success" value="System Case"/></a>
		</div></div>';	
	}
	else
	{
	}

}
else if($casetype == "For Game")
{
	$points = $_GET['points'];
	
	if(isset($_GET['timeup']) && isset($_GET['pid']))
	{					
		$update = "Update caseprocess set status='Incomplete',timer='0' where pid='$pid'";				
		if(mysqli_query($con, $update))
		{		
		}
		else
		{
		}
		
		echo "<center><h3>Your Time is Up. You have not successfully attempted all the Questions</br></br>
		Your Total Points Earned : ".$points." pts</h3></center>";				
	}

	if(isset($_GET['quest']) && isset($_GET['pid']))
	{			
		$update = "Update caseprocess set status='Finished',timer='' where pid='$pid'";				
		if(mysqli_query($con, $update))
		{		
		}
		else
		{
		}

		echo "<center><h3>Your Case is Finished</br></br>
		Your Total Points Earned : ".$points." pts</h3></center>";	
	}
	
} 	
	

?>

  
</div>
</div>


<?php include('footer.php')?>