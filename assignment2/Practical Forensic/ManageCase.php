<?php include('AdminHeader.php');

$val = !empty($_SESSION["adminid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php'</script>";
}
$adminid_session = $_SESSION["adminid_session"];
?>


<div class="content">
<div class="container">

<div class="modal small fade" id="myModalDel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                
                 <h3 id="myModalLabel">Delete Confirmation</h3>

            </div>
            <div class="modal-body">
                <p class="error-text" style="font-size:17px;"><i class="fa fa-warning modal-icon"></i> Are you sure you want to delete?
                    </p>
            </div>
            <div class="modal-footer">
               <button class="btn btn-default"data-dismiss="modal" aria-hidden="true">No</button> <a href="#" class="btn btn-danger" id="modalDelete">Yes</a>
            </div>
        </div>
    </div>
</div>


	<div id="searchbox">
		<form method="post">
			<div class="input-group" style="width: 30%;">
				<input name="search_name" type="text" class="form-control" placeholder="Search Case Name">
				<div class="input-group-btn">
					<button class="btn btn-primary" name="btn_search" type="submit">
						<i class="fa fa-search" aria-hidden="true" style="font-size: 15px;"></i>
						
					</button>
				</div>
			</div>	
		</form>	
	</div>	 

	<div class="col-md-12" style="margin-top:2%;">
		<table class="table table-bordered table-hover">
			
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
				$sel = "select caseid,casetype,casename,time,date from cases Order by date desc";				
			}
			else
			{
				$sel = "select caseid,casetype,casename,time,date from cases where casename like '%$search_name%' Order by date desc";
			}
			
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
				<th>Case ID</th>
				<th>Case Type</th>
				<th>Case Name</th>
				<th>Date</th>
				<th>Time</th>
				<th>Action</th>
				<th>Action</th>
				</tr>
				</thead>

				<tbody>';
					  
				while($data=mysqli_fetch_array($rel))
				{
					$caseid=$data['caseid'];					
					$casetype=$data['casetype'];
					$casename=$data['casename'];
					$time=$data['time'];							
					$date=$data['date'];
					
					
					echo'<td>'.$caseid.'</td>
					<td>'.$casetype.'</td>
					<td>'.$casename.'</td>					
					<td>'.$date.'</td>
					<td>'.$time.'</td>					
					<td><a href="UpdateCases.php?caseid='.$caseid.'" class="btn btn-primary">View More Details</a></td>
					<td><a href="#myModalDel" class="btn btn-danger trash" id="'.$caseid.'" role="button" data-toggle="modal">Delete</a></button></td>	
					</tr>';					
				}
				echo'</tbody>';
			}		
					
			?>
						 			
		 </table>
	</div>
		
</div>		
</div>


<?php include('footer.php') ?>


<script>

$('.trash').click(function(){	
    var id = $(this).attr('id');
    $('#modalDelete').attr('href','modal_delcases.php?id='+id);
	
});

</script>