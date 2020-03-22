<?php include('AdminHeader.php');

$val = !empty($_SESSION["adminid_session"])?$_SESSION:" ";

if($val == " ")
{
	echo"<script>window.location.href='Login.php?login=admin'</script>";
}
$adminid_session = $_SESSION["adminid_session"];
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
			  <label class="radio-inline"><input type="radio" name="optradio_ctype" value="For Game" checked>For Game</label>
			  <label class="radio-inline"><input type="radio" name="optradio_ctype" value="For Practice">For Practice</label>
		  </div>
		</div>
		
		<div class="col-md-8 col-md-offset-3">
		  <div class="col-md-4">
		  <h4>Case Name :</h4>
		  </div>
		  <div class="col-md-8">
			<input type="text" name="casename" class="form-control" />
		  </div>
		</div>
				
		<div class="col-md-8 col-md-offset-2">
		<div class="col-md-12" style="margin-top: 2%;">
			<div class="col-md-4">
				<h4>Scenario :</h4>
			</div>
			<div class="col-md-8">
				<textarea class="form-control" name="scenario" rows="5"></textarea>
			</div>
		</div>
		
		<div class="col-md-12" style="margin-top: 2%;">
			<div class="col-md-4">
				<h4>Findings :</h4>
			</div>
			<div class="col-md-8">
				<textarea class="form-control" name="finding" rows="5"></textarea>
			</div>
		</div>
		</div>
		
		<div class="col-md-8 col-md-offset-2">
		<div class="col-md-12" style="margin-top: 2%;">
			<div class="col-md-4">
				<h4>Evidence :</h4>
			</div>
			<div class="col-md-8">
				<input type="file" name="fileToUpload[]" multiple />
				<label id="validation_upload" style="color:red; font-size:14px; display:none;"></label>
			</div>
		</div>
		
		<div class="col-md-12" style="margin-top: 2%;" id="time_div">
			<div class="col-md-4">
				<h4>Time :</h4>
			</div>
			<div class="col-md-8">
				<input type="number" name="time" class="time_btns"></br>
				<span style="font-size: 16px;">Minutes(e.g. 30)</span>
			</div>
		</div>
		</div>
			
		<div class="col-md-8 col-md-offset-2">
		<div class="col-md-12" style="margin-top: 2%;">
			<div class="col-md-4">
			</div>
			<div class="col-md-8">
				<input class="btn btn-success" type="submit" name="btn_submit" value="Submit">
			</div>
		</div>
		</div>		
		
	</div>
	
</form>	
		
</div>		
</div>

<?php 

if(isset($_POST['btn_submit']))
{	
    $optradio_ctype = $_POST['optradio_ctype'];
	$casename = $_POST['casename'];	
	$casename = addslashes($casename);
	$scenario = $_POST['scenario'];
	$scenario = addslashes($scenario);
	$finding = $_POST['finding'];
	$finding = addslashes($finding);
	$time = $_POST['time'];
	

	$date = date("Y-m-d");
	
	$var="select max(caseid) as caseid from cases";
	$res_var=$con->query($var);
	$row = mysqli_fetch_assoc($res_var);
	$caseid_row = $row['caseid'];	
	if(!empty($caseid_row))
	{				
		$caseid = $caseid_row + 1;								
	}
	else
	{		
		$caseid = '101';						
	}
	
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

					if($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg" && $FileType !="pdf" && $FileType !="doc" && $FileType !="docx" && $FileType != "raw" && $FileType != "vmdk")
					{
						echo "<script>document.getElementById('validation_upload').innerHTML='Sorry, only .jpg,.png,.jpeg,.pdf,.doc,.docx above mentioned files are allowed.';</script>";
						echo "<script>document.getElementById('validation_upload').style.display = 'block';</script>";                  
					}
					else
					{
						//Upload the file into the temp dir
						if(move_uploaded_file($tmpFilePath, $newFilePath)) 
						{
							$ins1 = "Insert into evidence(caseid,file) values('$caseid',
							'".$_FILES['fileToUpload']['name'][$i]."')";						
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
				
				$ins = "Insert into cases(caseid,casetype,casename,scenario,finding,time,date) values('$caseid','$optradio_ctype','$casename','$scenario','$finding','$time','$date')";	
				if(mysqli_query($con, $ins))
				{						
					require 'PHPMailerAutoload.php';
					require("class.phpmailer.php");
					
															  					
					$sel = "select name,emailid from userregister";		
					$rel=$con->query($sel);
					/*while($data=mysqli_fetch_array($rel))
					{
						$recipients += array($data['emailid'] => $data['name']);			
						
					}*/
										
						$body="<h2 style='font-size:18px;'>Hello,</h2></br>
						<h3 style='font-size:17px; font-weight:normal;'>New Cases are added. Please Login and check</h3></br>		
						<h4 style='font-size:16px; font-weight:normal;'>Regards,</h4></br>
						<h4>Practical Forensics 101</h4></br>";
								 
						$mail = new PHPMailer(); 
						$mail->IsSMTP(); // send via SMTP
						//IsSMTP(); // send via SMTP
													
						$mail->SMTPOptions = array(
								'ssl' => array(
								'verify_peer' => false,
								'verify_peer_name' => false,
								'allow_self_signed' => true
							)
						);
						$mail->SMTPAuth = true; // turn on SMTP authentication
						$mail->Host = "smtp.gmail.com"; 
						$mail->Port=587;
						//$mail->Host="localhost";
						$mail->Username = ""; // SMTP username(Your email id)
						$mail->Password = ""; // SMTP password(Your password)
						$webmaster_email = ""; //Reply to this email ID(Your email id)
						//$email=$emailid; // Recipients email ID
						//$name=$firstname; // Recipient's name
						$mail->From = $webmaster_email;
						$mail->FromName = "Practical Forensic";
						
						while($data=mysqli_fetch_array($rel))
						{
							//$recipients = array($data['emailid'] => $data['name']);			
							$mail->AddAddress($data['emailid'],$data['name']);
						}
						/*foreach($recipients as $email => $name)
						{
							$mail->AddAddress($email,$name);
						}*/
						
						$mail->AddReplyTo($webmaster_email,"Practical Forensic");
						$mail->WordWrap = 50; // set word wrap
						//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
						//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
						$mail->IsHTML(true); // send as HTML
						$mail->Subject = "New Case";
						$mail->Body = $body ; //HTML Body
						$mail->AltBody = "New Case"; //Text Body
						
						if(!$mail->Send())
						{
							echo "Mailer Error: " . $mail->ErrorInfo;							
						}
						else
						{
							echo "<script>alert('Case Added succesfully');</script>";
							echo "<script>window.location.href='ManageCase.php'</script>";								
						}
											
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
	
	
</script>

