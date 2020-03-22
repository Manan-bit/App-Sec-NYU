<?php session_start();
include("connection.php");

$uid_session = $_SESSION["uid_session"];

$casetype = $_GET['casetype'];

if($casetype == "For Practice")
{
	if(isset($_GET['caseid_new']))
	{
		$caseid = $_GET['caseid_new'];
		
		$sel_q="select * from questions where caseid='$caseid'";
		$rel_q=$con->query($sel_q);
		$caseid_count=mysqli_num_rows($rel_q);

		if($caseid_count == 0)
		{
			echo "<script>alert('Questions are not added for this Case. Please Add Questions.');</script>";
			echo "<script>window.location.href='ViewCase.php?casetype=".$casetype."'</script>";	
		}
		else
		{
			echo "<script>window.location.href='ViewCase.php?casetype=".$casetype."&caseid_new=".$caseid."'</script>";
		}
	}
	else
	{
		$caseid = $_GET['caseid'];
		$pid = $_GET['pid'];
		
		$sel_q="select * from questions where caseid='$caseid'";
		$rel_q=$con->query($sel_q);
		$caseid_count=mysqli_num_rows($rel_q);

		if($caseid_count == 0)
		{
			echo "<script>alert('Questions are not added for this Case. Please Add Questions.');</script>";
			echo "<script>window.location.href='ViewCase.php?casetype=".$casetype."'</script>";	
		}
		else
		{
			echo "<script>window.location.href='ViewCase.php?casetype=".$casetype."&caseid=".$caseid."&pid=".$pid."'</script>";
		}
	}
}
else if($casetype == "For Game")
{
	if(isset($_GET['caseid_new']))
	{
		$caseid = $_GET['caseid_new'];
		
		$sel_q="select * from questions where caseid='$caseid'";
		$rel_q=$con->query($sel_q);
		$caseid_count=mysqli_num_rows($rel_q);

		if($caseid_count == 0)
		{
			echo "<script>alert('Questions are not added for this Case. Please Add Questions.');</script>";
			echo "<script>window.location.href='ViewCase.php?casetype=".$casetype."'</script>";	
		}
		else
		{
			echo "<script>window.location.href='ViewCase.php?casetype=".$casetype."&caseid_new=".$caseid."'</script>";
		}
	}
	else
	{
		$caseid = $_GET['caseid'];
		$pid = $_GET['pid'];
		
		$sel_q="select * from questions where caseid='$caseid'";
		$rel_q=$con->query($sel_q);
		$caseid_count=mysqli_num_rows($rel_q);

		if($caseid_count == 0)
		{
			echo "<script>alert('Questions are not added for this Case. Please Add Questions.');</script>";
			echo "<script>window.location.href='ViewCase.php?casetype=".$casetype."'</script>";	
		}
		else
		{
			echo "<script>window.location.href='ViewCase.php?casetype=".$casetype."&caseid=".$caseid."&pid=".$pid."'</script>";
		}
	}

}	

?>