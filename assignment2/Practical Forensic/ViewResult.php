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

?>

<h3 style="text-align:center;">View Results</h3>
<h4 style="float:left;"><i class="fa fa-arrow-left" style="font-size:18px;color:blue"></i><a href="ViewCase.php?casetype=<?php echo $casetype ?>">View Case</a></h4>

</br>

<?php

if(isset($_GET['timeup']) && isset($_GET['pid']))
{
	$pid = $_GET['pid'];
			
	$sel="select qid,useranswer,status from useranswer where pid='$pid' and uid='$uid_session'";
	$rel=$con->query($sel);
	if(mysqli_num_rows($rel)==0)
	{			  
		echo "<center><h3>You have not attempted any of the Questions!!!</h3></center>";
		$delete = "Delete from caseprocess where pid='$pid'";				
		if(mysqli_query($con, $delete))
		{		
		}
		else
		{
		}	
	}
	else
	{
		$update = "Update caseprocess set status='Incomplete',timer='0' where pid='$pid'";				
		if(mysqli_query($con, $update))
		{		
		}
		else
		{
		}
		
		while($data=mysqli_fetch_array($rel))
		{
			$qid[] = $data['qid'];
			$useranswer[] = $data['useranswer'];
			$status[] = $data['status'];
		}

		$count_qid = count($qid);
	
	
		for($i = 0; $i < $count_qid; $i++)
		{	
			$sel2 ="select question,answer from questions where qid='$qid[$i]'";
			$rel2=$con->query($sel2);
			while($data2=mysqli_fetch_array($rel2))
			{
				echo'<div class="col-md-12 col-lg-12">
				<h4><b>Q:</b> '.$data2['question'].'</h4>';
				
				if($status[$i] == "Right")
				{
					echo'<h4><b>User Answer:</b> <span style="color:green; font-size: 20px;">'.$useranswer[$i].'</span></h4>';
				}
				else if($status[$i] == "Wrong")
				{
					echo'<h4><b>User Answer:</b> <span style="color:red; font-size: 20px;">'.$useranswer[$i].'</span></h4>';
				}
			
				echo'<h4><b>Correct Answer:</b> <span style="color:green; font-size: 20px;">'.$data2['answer'].'</span></h4>    
				</div>';										
			}						
		}
	
	}
		
}


if(isset($_GET['quest']) && isset($_GET['pid']))
{
	$pid = $_GET['pid'];
	
	$sel="select qid,useranswer,status from useranswer where pid='$pid' and uid='$uid_session'";
	$rel=$con->query($sel);
	if(mysqli_num_rows($rel)==0)
	{			  
		echo "<center><h3>You have not attempted any of the Questions!!!</h3></center>";
		$delete = "Delete from caseprocess where pid='$pid'";				
		if(mysqli_query($con, $delete))
		{		
		}
		else
		{
		}	
	}
	else
	{
		$update = "Update caseprocess set status='Finished',timer='' where pid='$pid'";				
		if(mysqli_query($con, $update))
		{		
		}
		else
		{
		}
		
		while($data=mysqli_fetch_array($rel))
		{
			$qid[] = $data['qid'];
			$useranswer[] = $data['useranswer'];
			$status[] = $data['status'];
		}

		$count_qid = count($qid);
		
		
		for($i = 0; $i < $count_qid; $i++)
		{
			$sel2 ="select question,answer from questions where qid='$qid[$i]'";
			$rel2=$con->query($sel2);
			while($data2=mysqli_fetch_array($rel2))
			{
				echo'<div class="col-md-12 col-lg-12">
				<h4><b>Q:</b> '.$data2['question'].'</h4>';
				
				if($status[$i] == "Right")
				{
					echo'<h4><b>User Answer:</b> <span style="color:green; padding:6px; font-size: 20px;">'.$useranswer[$i].'</span></h4>';
				}
				else if($status[$i] == "Wrong")
				{
					echo'<h4><b>User Answer:</b> <span style="color:red; padding:6px; font-size: 20px;">'.$useranswer[$i].'</span></h4>';
				}
				
				echo'<h4><b>Correct Answer:</b> <span style="color:green; font-size: 20px;">'.$data2['answer'].'</span></h4>    
				</div>';										
			}						
		}
	}
	
}

if(isset($_GET['endtest']) && isset($_GET['pid']))
{
	$pid = $_GET['pid'];
		
	$sel="select qid,useranswer,status from useranswer where pid='$pid' and uid='$uid_session'";
	$rel=$con->query($sel);
	if(mysqli_num_rows($rel)==0)
	{			  
		echo "<center><h3>You have not attempted any of the Questions!!!</h3></center>";
		$delete = "Delete from caseprocess where pid='$pid'";				
		if(mysqli_query($con, $delete))
		{		
		}
		else
		{
		}	
	}
	else
	{
		$update = "Update caseprocess set status='Incomplete',timer='' where pid='$pid'";				
		if(mysqli_query($con, $update))
		{		
		}
		else
		{
		}
		
		while($data=mysqli_fetch_array($rel))
		{
			$qid[] = $data['qid'];
			$useranswer[] = $data['useranswer'];
			$status[] = $data['status'];
		}

		$count_qid = count($qid);
		
		
		for($i = 0; $i < $count_qid; $i++)
		{
			$sel2 ="select question,answer from questions where qid='$qid[$i]'";
			$rel2=$con->query($sel2);
			while($data2=mysqli_fetch_array($rel2))
			{
				echo'<div class="col-md-12 col-lg-12">
				<h4><b>Q:</b> '.$data2['question'].'</h4>';
				
				if($status[$i] == "Right")
				{
					echo'<h4><b>User Answer:</b> <span style="color:green; padding:6px; font-size: 20px;">'.$useranswer[$i].'</span></h4>';
				}
				else if($status[$i] == "Wrong")
				{
					echo'<h4><b>User Answer:</b> <span style="color:red; padding:6px; font-size: 20px;">'.$useranswer[$i].'</span></h4>';
				}
				
				echo'<h4><b>Correct Answer:</b> <span style="color:green; font-size: 20px;">'.$data2['answer'].'</span></h4>    
				</div>';										
			}						
		}
	}
	
}



?>

   
</div>
</div>


<?php include('footer.php')?>