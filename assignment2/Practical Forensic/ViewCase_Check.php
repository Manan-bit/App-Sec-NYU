<?php session_start();
include("connection.php");

$casetype = $_GET['casetype'];

if($casetype == "For Practice")
{
	if(isset($_GET['caseid_new']))
	{
		$caseid = $_GET['caseid_new'];
			
		if($caseid == 101)
		{
			echo "<script>window.location.href='StartCase_Email.php?casetype=".$casetype."&caseid_new=".$caseid."'</script>";
		}
		else if($caseid == 102)
		{
			echo "<script>window.location.href='StartCase_System.php?casetype=".$casetype."&caseid_new=".$caseid."'</script>";
		}	
		else if($caseid == 103)
		{
			echo "<script>window.location.href='StartCase_Network.php?casetype=".$casetype."&caseid_new=".$caseid."'</script>";
		}
		else
		{
			echo "<script>window.location.href='ViewCase_Yes.php?casetype=".$casetype."&caseid_new=".$caseid."'</script>";
		}
	}
	else
	{
		$caseid = $_GET['caseid'];
		
			
		if($caseid == 101)
		{
			echo "<script>window.location.href='StartCase_Email.php?casetype=".$casetype."&caseid=".$caseid."'</script>";
		}
		else if($caseid == 102)
		{
			echo "<script>window.location.href='StartCase_System.php?casetype=".$casetype."&caseid=".$caseid."'</script>";
		}	
		else if($caseid == 103)
		{
			echo "<script>window.location.href='StartCase_Network.php?casetype=".$casetype."&caseid=".$caseid."'</script>";
		}
		else
		{
			echo "<script>window.location.href='ViewCase_Yes.php?casetype=".$casetype."&caseid=".$caseid."'</script>";
		}
	}	
}
else if($casetype == "For Game")
{	
	if(isset($_GET['caseid_new']))
	{
		$caseid = $_GET['caseid_new'];
					
		echo "<script>window.location.href='ViewCase_Yes.php?casetype=".$casetype."&caseid_new=".$caseid."'</script>";
	}
	else
	{
		$caseid = $_GET['caseid'];
		
		echo "<script>window.location.href='ViewCase_Yes.php?casetype=".$casetype."&caseid=".$caseid."'</script>";
		
	}	
}

?>