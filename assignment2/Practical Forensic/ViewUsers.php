<?php include('AdminHeader.php');

$val = !empty($_SESSION["adminid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?login=admin'</script>";
}
$adminid_session = $_SESSION["adminid_session"];
?>


<div class="content">
<div class="container">

<h3 style="text-align:center;">View Users</h3>

<?php
	
$search_name="";

if(isset($_POST['btn_search']))
{
    $search_name = $_POST['search_name'];
}
else
{
   $search_name = "";
}


if($search_name == "")
{	 
	$sel = "select name,gender,age,contactno,emailid,address,city from userregister";	     
}
else
{
    $sel = "select name,gender,age,contactno,emailid,address,city from userregister where name like '%$search_name%'";
}

?>


<form method="post">
	<div id="searchbox">
		<div class="input-group" style="width: 30%;">
			<input name="search_name" type="text" class="form-control" placeholder="Search User Name" autocomplete="off">
			<div class="input-group-btn">
				<button class="btn btn-primary" name="btn_search" type="submit">
					<i class="fa fa-search" aria-hidden="true" style="font-size: 15px;"></i>
				</button>
			</div>
		</div>
	</div>	
</form>
</br>

	<table class="table table-bordered table-hover">
			
	<?php
						
	$rel=$con->query($sel);
	if(mysqli_num_rows($rel)==0)
	{			  
		echo "<center><h3>No records to display</h3></center>";
		echo "<script>document.getElementById('searchbox').style.display='none'</script>";
	}
	else
	{
		echo "<script>document.getElementById('searchbox').style.display='block'</script>";	
		echo'<thead style="background-color:grey;color:white">           
		<tr>	
		<th>Name</th>				
		<th>Gender</th>
		<th>Age</th>
		<th>Contact No.</th>
		<th>Email ID</th>
		<th>Address</th>
		<th>City</th>		
		</tr>
		</thead>

		<tbody>';
			  
		while($data=mysqli_fetch_array($rel))
		{
			$name=$data['name'];	
			$gender=$data['gender'];
			$age=$data['age'];
			$contactno=$data['contactno'];
            $emailid=$data['emailid'];
			$address=$data['address'];
			$city=$data['city'];
			
			echo'<tr>
			<td>'.$name.'</td>	
			<td>'.$gender.'</td>
			<td>'.$age.'</td>
			<td>'.$contactno.'</td>
			<td>'.$emailid.'</td>
			<td>'.$address.'</td>
			<td>'.$city.'</td>
			</tr>';
			
		}
	}
			
	?>
				 
	</tbody>
  </table>
   
</div>
</div>


<?php include('footer.php')?>
