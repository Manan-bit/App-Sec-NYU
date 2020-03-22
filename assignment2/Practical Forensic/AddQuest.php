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

<form id="myform" method="post" enctype="multipart/form-data"> 

<div class="row">
	<div class="col-md-3 col-lg-3"></div>

	<div class="col-md-6 col-lg-6 div_quest">	
			<div class="col-md-12">				
				<h4>Select a Case :</h4>				
				<select name="selc_case" id="cases" class="form-control" onchange="change_cases()">
					<?php						
						$sel="select caseid,casename from cases";
						$rel=$con->query($sel);

						if(mysqli_num_rows($rel)==0)
						{
							echo "<option value='nodata'>--No records to display--</option>";
						}
						else
						{
							echo'<option value="--Select Case Name--">--Select Case Name--</option>';
							while($data=mysqli_fetch_array($rel))
							{                            
							    echo "<option value='".$data['caseid']."'>".$data['casename']."</option>";						             
							}
						}
							
					?>
				</select>				
			</div>

		  <div class="col-md-12" style="margin-top:10%;">
			<label>Question :</label>
			<input type="text" name="txtbxquest" class="form-control"/>
		  </div>
		  
		  <div class="col-md-12" style="margin-top:10%;">
			<label>Answer :</label>
			<input type="text" name="txtbxans" class="form-control" />
		  </div>
		  
		  <div class="col-md-12" style="margin-top:10%;">
			<label>Hint :</label>
			<input type="text" name="txtbxhint" class="form-control" />
		  </div>
		  
		  <div class="col-md-12" style="margin-top:10%;">
			<label>Question Info :</label>
			<input type="text" name="txtbxqinfo" class="form-control" />
		  </div>
		 
		<div id="steps_div" style="display:none;">
			  <div class="col-md-12" style="margin-top:10%;">
				<label>Step 1 :</label>
				<input type="text" name="txtbxstep1" class="form-control" />
			  </div>
			  
			  <div class="col-md-12" style="margin-top:10%;">
				<label>Step 2 :</label>
				<input type="text" name="txtbxstep2" class="form-control" />
			  </div>
			  
			  <div class="col-md-12" style="margin-top:10%;">
				<label>Step 3 :</label>
				<input type="text" name="txtbxstep3" class="form-control" />
			  </div>
			  
			  <div class="col-md-12" style="margin-top:10%;">
				<label>Step 4 :</label>
				<input type="text" name="txtbxstep4" class="form-control" />
			  </div>
			  
			  <div class="col-md-12" style="margin-top:10%;">
				<label>Step 5 :</label>
				<input type="text" name="txtbxstep5" class="form-control" />
			  </div>
			  
			  <div class="col-md-12" style="margin-top:10%;">
				<label>Step 6 :</label>
				<input type="text" name="txtbxstep6" class="form-control" />
			  </div>
		 </div>
		 
		  <div class="col-md-12 text-center" style="margin-top:10%;">
			<input type="submit" name="btn_submit" class="btn btn-success" value="Submit"/>
		  </div>
	 </div>
		
	<div class="col-md-3 col-lg-3"></div>	
		
</div>

			
</form>
		
</div>		
</div>

<?php 

if(isset($_POST['btn_submit']))
{	
   $selc_case = $_POST['selc_case'];
   
   $txtbxquest = $_POST['txtbxquest'];
   $txtbxquest = htmlentities($txtbxquest,ENT_QUOTES,"UTF-8");
   
   $txtbxans = $_POST['txtbxans'];
   $txtbxans = htmlentities($txtbxans,ENT_QUOTES,"UTF-8");
   
   $txtbxhint = $_POST['txtbxhint'];
   $txtbxhint = htmlentities($txtbxhint,ENT_QUOTES,"UTF-8");
   
   $txtbxqinfo = $_POST['txtbxqinfo'];
   $txtbxqinfo = htmlentities($txtbxqinfo,ENT_QUOTES,"UTF-8");
   
   $txtbxstep1 = $_POST['txtbxstep1'];
   $txtbxstep1 = htmlentities($txtbxstep1,ENT_QUOTES,"UTF-8");

   $txtbxstep2 = $_POST['txtbxstep2'];
   $txtbxstep2 = htmlentities($txtbxstep2,ENT_QUOTES,"UTF-8");
   
   $txtbxstep3 = $_POST['txtbxstep3'];
   $txtbxstep3 = htmlentities($txtbxstep3,ENT_QUOTES,"UTF-8");
   
   $txtbxstep4 = $_POST['txtbxstep4'];
   $txtbxstep4 = htmlentities($txtbxstep4,ENT_QUOTES,"UTF-8");
   
   $txtbxstep5 = $_POST['txtbxstep5'];
   $txtbxstep5 = htmlentities($txtbxstep5,ENT_QUOTES,"UTF-8");
   
   $txtbxstep6 = $_POST['txtbxstep6'];
   $txtbxstep6 = htmlentities($txtbxstep6,ENT_QUOTES,"UTF-8");
   
  		
	$ins = "Insert into questions(caseid,question,answer,hint,qinfo,step1,step2,step3,step4,step5,step6) values
	('$selc_case','$txtbxquest','$txtbxans','$txtbxhint','$txtbxqinfo','$txtbxstep1','$txtbxstep2','$txtbxstep3','$txtbxstep4','$txtbxstep5','$txtbxstep6')";	
	if(mysqli_query($con, $ins))
	{
		echo "<script>alert('Question Added succesfully');</script>";
		echo "<script>window.location.href='AddQuest.php';</script>";
	}
	else
	{
		echo "<script>alert('Invalid');</script>";
	}
	
	
}


include('footer.php') 

?>

<script type="text/javascript">
	
$(function()
    {
		 $.validator.addMethod("value_case", function(value, element, arg){
		  return arg !== value;
		 },);
		
		
            $("#myform").validate({            
            rules:{
				selc_case: { value_case: "--Select Case Name--" },
				txtbxquest : "required",
				txtbxans : "required",
				txtbxhint : "required",
				
            },

            messages:{
				selc_case: { value_case: "<h5 style='color:red; font-size:15px;'><b>Please Select Case Name</b></h5>" },
				txtbxquest:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Question</b></h5>",
				txtbxans:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Answer</b></h5>",
				txtbxhint:"<h5 style='color:red;font-size: 15px;'><b>Please Enter Valid Hint</b></h5>",
            },

            submitHandler: function(form){
                form.submit();
            }

        });

    });	
	
	
	
	function change_cases()
	{
		var caseid = $("#cases").val();
	
		$.ajax({
		url: "select_casetype.php",
		method: "POST",
		data: {caseid: caseid},
		dataType: "json",
		success:function(data)
		{
			if(data.casetype == "For Practice")
			{
				$("#steps_div").show();
			}
			else if(data.casetype == "For Game")
			{
				$("#steps_div").hide();
			}
			
		}
		
	});
		
		
		
		
		
	}	
		
	
</script>


