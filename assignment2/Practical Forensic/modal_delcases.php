<?php
include("connection.php");

      $del_caseid = $_GET['id'];
	  
      $delete = "delete from cases where caseid='$del_caseid'";
      
      if(mysqli_query($con, $delete))
      {		
		echo "<script>alert(Case deleted successfully');</script>";
		echo "<script>window.location.href='ManageCase.php'</script>";		   
      } 
      else
      {
        echo "<script>alert('Error while deleting');</script>";
      }

?>