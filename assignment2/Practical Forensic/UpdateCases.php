<?php include('AdminHeader.php');

$val = !empty($_SESSION["adminid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?login=admin'</script>";
}
$adminid_session = $_SESSION["adminid_session"];


$caseid = $_GET['caseid'];


$sel = "select casetype,casename,scenario,finding,time from cases";		
$rel=$con->query($sel);
if($data=mysqli_fetch_assoc($rel))
{
	$casetype=$data['casetype'];
	$casename=$data['casename'];	
	$scenario=$data['scenario'];
	$finding=$data['finding'];
    $time=$data['time'];	
}



?>

<style>
.time_btns::-webkit-inner-spin-button, 
.time_btns::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0; 
}

</style>

<div class="content">
<div class="container">

<form id="myform" method="post" enctype="multipart/form-data"> 

		<div class="col-md-12 case_div">
        <div class="col-md-6 col-md-offset-3">
		  <div class="col-md-6">
		  <h4>Type of Case :</h4>
		  </div>
		  <div class="col-md-6">
		  
		  <?php
		  
		  if($casetype == "For Game")
		  {
		 ?>
			<label class="radio-inline"><input type="radio" name="optradio_ctype" value="For Game" checked>For Game</label>
			<label class="radio-inline"><input type="radio" name="optradio_ctype" value="For Practice">For Practice</label>
		<?php
		  }
		  else if($casetype == "For Practice")
		  {
		?>
			<label class="radio-inline"><input type="radio" name="optradio_ctype" value="For Game">For Game</label>
			<label class="radio-inline"><input type="radio" name="optradio_ctype" value="For Practice" checked>For Practice</label>
		<?php
		  }		  
		  ?>
		  			  
		  </div>
		</div>
		
		<div class="col-md-8 col-md-offset-3">
		  <div class="col-md-4">
		  <h4>Case Name :</h4>
		  </div>
		  <div class="col-md-8">
			<input type="text" name="casename" class="form-control" value="<?php echo $casename ?>" />
		  </div>
		</div>
				
		<div class="col-md-8 col-md-offset-2">
		<div class="col-md-12" style="margin-top: 2%;">
			<div class="col-md-4">
				<h4>Scenario :</h4>
			</div>
			<div class="col-md-8">
				<textarea class="form-control" name="scenario" rows="5"><?php echo $scenario ?></textarea>
			</div>
		</div>
		
		<div class="col-md-12" style="margin-top: 2%;">
			<div class="col-md-4">
				<h4>Findings :</h4>
			</div>
			<div class="col-md-8">
				<textarea class="form-control" name="finding" rows="5"><?php echo $finding ?></textarea>
			</div>
		</div>
		</div>
		
		<div class="col-md-8 col-md-offset-2">
		<div class="col-md-12" style="margin-top: 2%;">
			<div class="col-md-4">
				<h4>Evidence :</h4>
			</div>
			<div class="col-md-5">
				<input type="file" name="fileToUpload[]" multiple />
				<label id="validation_upload" style="color:red; font-size:14px; display:none;"></label>								
			</div>
			
			<div class="col-md-3">
				<!--<input type="submit" name="btn_addfile" class="btn btn-success" value="Add Files"/>-->
			</div>
		</div>

		<div class="col-md-12" style="margin-top: 2%;">
			<div class="col-md-4">
				
			</div>
			<div class="col-md-6">
				<table class="table table-bordered table-hover">
			
				<?php
				$sel1 = "select id,file from evidence where caseid='$caseid'";
				$rel1=$con->query($sel1);
				if(mysqli_num_rows($rel1)==0)
				{			  
					echo "<center><h3>No files to display</h3></center>";					
				}
				else
				{					
					echo'<thead style="background-color:grey;color:white">           
					<tr>
					<th>Case ID</th>	
					<th>File Name</th>				
					<th>Action</th>					
					</tr>
					</thead>

					<tbody>';
						  
					while($data1=mysqli_fetch_array($rel1))
					{	
						$file=$data1['file'];
						$id=$data1['id'];
						
						echo'<tr>
						<td>'.$caseid.'</td>
						<td>'.$file.'</td>				
						<td><a href="#myModal" class="btn btn-danger trash" id="'.$id.'" role="button" data-toggle="modal">Delete</a></td>
						</tr>';
						
					}
					echo'</tbody>';
				}
						
				?>
							 				
			  </table>						
			</div>
			
			<div class="col-md-2">				
			</div>
			
		</div>
		
		<div class="col-md-12" style="margin-top: 2%;" id="time_div">
			<div class="col-md-4">
				<h4>Time :</h4>
			</div>
			<div class="col-md-8">
				<input type="number" name="time" id="input_time" class="time_btns" value="<?php echo $time ?>"></br>
				<span style="font-size: 16px;">Minutes(e.g. 30)</span>
			</div>
		</div>
		</div>
			
		<div class="col-md-8 col-md-offset-2">
		<div class="col-md-12" style="margin-top: 2%;">
			<div class="col-md-4">
			</div>
			<div class="col-md-8">
				<input class="btn btn-success" type="submit" name="btn_update" value="Submit">
			</div>
		</div>
		</div>		
		
	</div>
	
</form>	
		
</div>		
</div>


<div class="modal small fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
               <button class="btn btn-default"data-dismiss="modal" aria-hidden="true">No</button> <a href="#" class="btn btn-danger" id="modalDelete" >Yes</a>

            </div>
        </div>
    </div>
</div>


<?php 


if(isset($_POST['btn_update']))
{	
    $optradio_ctype = $_POST['optradio_ctype'];
	$casename = $_POST['casename'];
	$casename = addslashes($casename);	
	$scenario = $_POST['scenario'];
	$scenario = addslashes($scenario);
	$finding = $_POST['finding'];
	$finding = addslashes($finding);
	$time = $_POST['time'];
	
	
	$file=$_FILES['fileToUpload']['tmp_name'];
    $iname=$_FILES['fileToUpload']['name'];	
    
       if(isset($iname))
       {
            if(!empty($iname))
            {
				$totalfiles = count($_FILES['fileToUpload']['name']);
								
				for( $i=0 ; $i < $totalfiles ; $i++ ) {

				  //Get the temp file path
				  $tmpFilePath = $_FILES['fileToUpload']['tmp_name'][$i];

				  //Make sure we have a file path
				  if ($tmpFilePath != ""){
					//Setup our new file path
					$newFilePath = "./files/" . $_FILES['fileToUpload']['name'][$i];
					$FileType = strtolower(pathinfo($newFilePath,PATHINFO_EXTENSION));

					if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType !="pdf")
					{
						echo "<script>document.getElementById('validation_upload').innerHTML='Sorry, only .jpg,.png,.jpeg above mentioned files are allowed.';</script>";
						echo "<script>document.getElementById('validation_upload').style.display = 'block';</script>";                  
					}
					else
					{
						//Upload the file into the temp dir
						if(move_uploaded_file($tmpFilePath, $newFilePath)) 
						{
							$ins1 = "Insert into evidence(caseid,file) values('$caseid',
							'".$_FILES['fileToUpload']['name'][$i]."')";
							echo $ins1;							
							if(mysqli_query($con, $ins1))
							{							
							}
							else
							{
							}

						}
						
					}
					
				  }
				}

				$update = "Update cases set casetype='$optradio_ctype',casename='$casename',scenario='$scenario',finding='$finding',time='$time' where caseid='$caseid'";	
				if(mysqli_query($con, $update))
				{							
					echo "<script>alert('Case Updated succesfully');</script>";
					echo "<script>window.location.href='ManageCase.php'</script>";		
				}	
				else
				{
					echo "<script>alert('Invalid');</script>";
				}
			}
			else
			{
				//echo "<script>alert('Please Upload Image');</script>";
			}
	   }
												
}

include('footer.php')

?>

<script type="text/javascript">

	$("input[name='optradio_ctype']").click(function() {
		var radio = $(this).val();
			
		if(radio == "For Game")
		{
			$("#time_div").show();
		}
		else if(radio == "For Prac")
		{
			$("#input_time").val("");
			$("#time_div").hide();
		}

	});
	
		
	$(function()
    {
            $("#myform").validate({
            
            rules:{
				casename : "required",
				scenario: "required",
				finding: "required",
				fileToUpload: "required",
				time: "required",				
           },

            messages:{				
				casename:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Case Name </b></h5>",
				scenario:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Scenario </b></h5>",
				finding:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Finding</b></h5>",
				fileToUpload:"<h5 style='color:red;font-size: 15px;'><b>Please Upload File</b></h5>",
				time:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Time </b></h5>",				
                							
            },

            submitHandler: function(form){
                form.submit();
            }

        });

    }); 
	
	
	$('.trash').click(function(){		
		var id = $(this).attr('id');
		$('#modalDelete').attr('href','modal_delfile.php?id='+id);
		
	});
	
	
</script>

