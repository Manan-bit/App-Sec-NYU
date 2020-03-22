<?php
include("connection.php");

      $del_fileid = $_GET['id'];
	  
      $delete = "delete from evidence where id='$del_fileid'";
      
      if(mysqli_query($con, $delete))
      {		
		echo "<script>alert(File deleted successfully');</script>";
		echo "<script>window.location.href='ManageCase.php'</script>";		   
      } 
      else
      {
        echo "<script>alert('Error while deleting');</script>";
      }

?>